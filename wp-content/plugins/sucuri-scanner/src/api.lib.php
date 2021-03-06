<?php

/**
 * Code related to the api.lib.php interface.
 *
 * @package Sucuri Security
 * @subpackage api.lib.php
 * @copyright Since 2010 Sucuri Inc.
 */

if (!defined('SUCURISCAN_INIT') || SUCURISCAN_INIT !== true) {
    if (!headers_sent()) {
        /* Report invalid access if possible. */
        header('HTTP/1.1 403 Forbidden');
    }
    exit(1);
}

/**
 * Plugin API library.
 *
 * When used in the context of web development, an API is typically defined as a
 * set of Hypertext Transfer Protocol (HTTP) request messages, along with a
 * definition of the structure of response messages, which is usually in an
 * Extensible Markup Language (XML) or JavaScript Object Notation (JSON) format.
 * While "web API" historically has been virtually synonymous for web service,
 * the recent trend (so-called Web 2.0) has been moving away from Simple Object
 * Access Protocol (SOAP) based web services and service-oriented architecture
 * (SOA) towards more direct representational state transfer (REST) style web
 * resources and resource-oriented architecture (ROA). Part of this trend is
 * related to the Semantic Web movement toward Resource Description Framework
 * (RDF), a concept to promote web-based ontology engineering technologies. Web
 * APIs allow the combination of multiple APIs into new applications known as
 * mashups.
 *
 * @see https://en.wikipedia.org/wiki/Application_programming_interface#Web_APIs
 */
class SucuriScanAPI extends SucuriScanOption
{
    /**
     * Seconds before consider a HTTP request as timeout.
     *
     * As for the 01/Jan/2016 if the number of seconds before a timeout is greater
     * than sixty (which is one minute) the method will reset the option to its
     * default value to keep the latency of the HTTP requests in a minimum to
     * minimize the interruptions in the admins workflow. The normal connection
     * timeout should be in the range of ten seconds, or fifteen if the DNS lookups
     * are slow.
     *
     * @return int Seconds to consider a HTTP request timeout.
     */
    public static function requestTimeout()
    {
        $timeout = (int) self::getOption(':request_timeout');

        if ($timeout > SUCURISCAN_MAX_REQUEST_TIMEOUT) {
            self::deleteOption(':request_timeout');

            return self::requestTimeout();
        }

        return $timeout;
    }

    /**
     * Alternative to the built-in PHP method http_build_query.
     *
     * Some PHP installations with different encoding or with different language
     * (German for example) might produce an unwanted behavior when building an
     * URL, because of this we decided to write our own URL query builder to
     * keep control of the output.
     *
     * @param array $params May be an array or object containing properties.
     * @return string Returns a URL-encoded string.
     */
    private static function buildQuery($params = array())
    {
        $trail = '';

        foreach ($params as $param => $value) {
            $value = urlencode($value);
            $trail .= sprintf('&%s=%s', $param, $value);
        }

        return substr($trail, 1);
    }

    /**
     * Sends a HTTP request via WordPress WP_HTTP class.
     *
     * @see https://secure.php.net/manual/en/book.curl.php
     * @see https://developer.wordpress.org/reference/classes/wp_http/request/
     *
     * @param string $url The target URL where the request will be sent.
     * @param string $method HTTP method that will be used to send the request.
     * @param array $params Parameters for the request defined in an associative array.
     * @param array $args Request arguments like the timeout, headers, cookies, etc.
     * @return array|string|bool HTTP response, JSON-decoded array, or false on failure.
     */
    public static function apiCall($url = '', $method = 'GET', $params = array(), $args = array())
    {
        if (!$url) {
            return self::throwException('URL is invalid');
        }

        if ($method !== 'GET' && $method !== 'POST') {
            return self::throwException('Only GET and POST methods allowed');
        }

        $response = null;
        $timeout = self::requestTimeout();
        $args = is_array($args) ? $args : array();

        if (isset($args['timeout'])) {
            $timeout = (int) $args['timeout'];
        }

        /* include request arguments */
        $args['method'] = $method;
        $args['timeout'] = $timeout;
        $args['redirection'] = 5;
        $args['httpversion'] = '1.1';
        $args['blocking'] = true;
        $args['sslverify'] = true;

        if (!array_key_exists('time', $params)) {
            $params['time'] = time();
        }

        /* support HTTP GET requests */
        if ($method === 'GET') {
            $args['body'] = null;
            $url .= '?' . self::buildQuery($params);
            $response = wp_remote_get($url, $args);
        }

        /* support HTTP POST requests */
        if ($method === 'POST') {
            $args['body'] = $params;
            $response = wp_remote_post($url, $args);
        }

        if (is_wp_error($response)) {
            return self::throwException($response->get_error_message());
        }

        /* try to return a JSON-encode object */
        if ($data = @json_decode($response['body'], true)) {
            return $data; /* associative array */
        }

        return $response['body'];
    }

    /**
     * Check whether the plugin API key is valid or not.
     *
     * @param string $api_key An unique string to identify this installation.
     * @return bool True if the API key is valid, false otherwise.
     */
    private static function isValidKey($api_key = '')
    {
        return (bool) @preg_match('/^[a-z0-9]{32}$/', $api_key);
    }

    /**
     * Store the API key locally.
     *
     * @param string $api_key An unique string of characters to identify this installation.
     * @param bool $validate Whether the format of the key should be validated before store it.
     * @return bool Either true or false if the key was saved successfully or not respectively.
     */
    public static function setPluginKey($api_key = '', $validate = false)
    {
        if ($validate && !self::isValidKey($api_key)) {
            return SucuriScanInterface::error(__('InvalidAPIKey', SUCURISCAN_TEXTDOMAIN));
        }

        if (!empty($api_key)) {
            SucuriScanEvent::notifyEvent('plugin_change', 'API key was successfully set: ' . $api_key);
        }

        return self::updateOption(':api_key', $api_key);
    }

    /**
     * Retrieve the API key from the local storage.
     *
     * @return string|bool The API key or false if it does not exists.
     */
    public static function getPluginKey()
    {
        $api_key = self::getOption(':api_key');

        if (is_string($api_key) && self::isValidKey($api_key)) {
            return $api_key;
        }

        return false;
    }

    /**
     * Call an action from the remote API interface of our WordPress service.
     *
     * @param string $method HTTP method that will be used to send the request.
     * @param array $params Parameters for the request defined in an associative array of key-value.
     * @param bool $send_api_key Whether the API key should be added to the request parameters or not.
     * @param array $args Request arguments like the timeout, redirections, headers, cookies, etc.
     * @return array|bool Response object after the HTTP request is executed.
     */
    public static function apiCallWordpress($method = 'GET', $params = array(), $send_api_key = true, $args = array())
    {
        $url = SUCURISCAN_API_URL;
        $params[SUCURISCAN_API_VERSION] = 1;
        $params['p'] = 'wordpress';

        if ($send_api_key) {
            $api_key = self::getPluginKey();

            if (!$api_key) {
                return false;
            }

            $params['k'] = $api_key;
        }

        return self::apiCall($url, $method, $params, $args);
    }

    /**
     * Determine whether an API response was successful or not checking the expected
     * generic variables and types, in case of an error a notification will appears
     * in the administrator panel explaining the result of the operation.
     *
     * For failures in the HTTP response:
     *
     * Log file not found: means that the API key used to execute the request is
     * not associated to the website, this may indicate that either the key was
     * invalidated by an administrator of the service or that the API key was
     * custom generated with invalid data.
     *
     * Wrong API key: means that the TLD of the origin of the request is not the
     * domain used to generate the API key in the first place, or that the email
     * address of the site administrator was changed so the data is not valid
     * anymore.
     *
     * Connection timeout: means that the API service is down either because the
     * hosting provider has connectivity issues or because the code is being
     * deployed. There is an option in the settings page that allows to temporarily
     * disable the communication with the API service while the server is down, this
     * allows the admins to keep the latency at zero and continue working in their
     * websites without interruptions.
     *
     * SSL issues: depending on the options used to compile the OpenSSL library
     * built by each hosting provider, the connection with the HTTPs version of the
     * API service may be rejected because of a failure in the SSL algorithm check.
     * There is an option in the settings page that allows to disable the SSL pair
     * verification, this option it disable automatically when the error is detected
     * for the first time.
     *
     * @param array $response HTTP response after API endpoint execution.
     * @param bool $enqueue Add the log to the local queue on a failure.
     * @return bool False if the API call failed, true otherwise.
     */
    public static function handleResponse($response = array(), $enqueue = true)
    {
        if (!$response || getenv('SUCURISCAN_NO_API_HANDLE')) {
            return false;
        }

        if (is_array($response)
            && array_key_exists('status', $response)
            && intval($response['status']) === 1
        ) {
            return true;
        }

        if (is_string($response) && !empty($response)) {
            return SucuriScanInterface::error($response);
        }

        if (!is_array($response)
            || !isset($response['messages'])
            || empty($response['messages'])
        ) {
            return SucuriScanInterface::error(__('ErrorNoInfo', SUCURISCAN_TEXTDOMAIN));
        }

        $msg = implode(".\x20", $response['messages']);
        $raw = $msg; /* Keep a copy of the original message. */

        // Special response for invalid API keys.
        if (stripos($raw, 'log file not found') !== false) {
            $key = SucuriScanOption::getOption(':api_key');
            $key = SucuriScan::escape($key);
            $msg .= sprintf(__('ErrorLogFileNotFound', SUCURISCAN_TEXTDOMAIN), $key);

            SucuriScanOption::deleteOption(':api_key');
        }

        // Special response for invalid firewall API keys.
        if (stripos($raw, 'wrong api key') !== false) {
            $key = SucuriScanOption::getOption(':cloudproxy_apikey');
            $key = SucuriScan::escape($key);
            $msg .= sprintf(__('ErrorWrongAPIKey', SUCURISCAN_TEXTDOMAIN), $key);

            SucuriScanOption::setRevProxy('disable', true);
            SucuriScanOption::setAddrHeader('REMOTE_ADDR', true);
            SucuriScanOption::deleteOption(':cloudproxy_apikey');

            return SucuriScanInterface::error($msg);
        }

        // Stop SSL peer verification on connection failures.
        if (stripos($raw, 'no alternative certificate')
            || stripos($raw, 'error setting certificate')
            || stripos($raw, 'SSL connect error')
        ) {
            $msg .= __('ErrorSSLCertificate', SUCURISCAN_TEXTDOMAIN);
        }

        // Check if the MX records as missing for API registration.
        if (strpos($raw, 'Invalid email') !== false) {
            $msg = __('ErrorInvalidEmail', SUCURISCAN_TEXTDOMAIN);
        }

        return SucuriScanInterface::error($enqueue ? $msg : '');
    }

    /**
     * Send a request to the API to register this site.
     *
     * @param string $email Optional email address for the registration.
     * @return bool True if the API key was generated, false otherwise.
     */
    public static function registerSite($email = '')
    {
        if (!is_string($email) || empty($email)) {
            $email = self::getSiteEmail();
        }

        $response = self::apiCallWordpress('POST', array(
            'e' => $email,
            's' => self::getDomain(),
            'a' => 'register_site',
        ), false);

        if (self::handleResponse($response)) {
            self::setPluginKey($response['output']['api_key']);

            SucuriScanEvent::scheduleTask(); /* install scheduled tasks */
            SucuriScanEvent::notifyEvent('plugin_change', 'API key was generated and set');
            return SucuriScanInterface::info(__('AlertAPIKeySet', SUCURISCAN_TEXTDOMAIN));
        }

        return false;
    }

    /**
     * Send a request to recover a previously registered API key.
     *
     * @return bool True if the API key was sent to the admin email, false otherwise.
     */
    public static function recoverKey()
    {
        $domain = self::getDomain();

        $response = self::apiCallWordpress('GET', array(
            'e' => self::getSiteEmail(),
            's' => $domain,
            'a' => 'recover_key',
        ), false);

        if (self::handleResponse($response)) {
            SucuriScanEvent::notifyEvent('plugin_change', 'API key recovery for domain: ' . $domain);
            return SucuriScanInterface::info($response['output']['message']);
        }

        return false;
    }

    /**
     * Send a request to the API to store and analyze the events of the site. An
     * event can be anything from a simple request, an internal modification of the
     * settings or files in the administrator panel, or a notification generated by
     * this plugin.
     *
     * @param string $event Event triggered by the core system functions.
     * @param int $time Timestamp when the event was originally triggered.
     * @param bool $enqueue Add the log to the local queue on a failure.
     * @return bool True if the event was logged, false otherwise.
     */
    public static function sendLog($event = '', $time = 0, $enqueue = true)
    {
        if (empty($event)) {
            return self::throwException('Event identifier cannot be empty');
        }

        $params = array();
        $params['a'] = 'send_log';
        $params['m'] = $event;

        if (intval($time) > 0) {
            $params['time'] = (int) $time;
        }

        $response = self::apiCallWordpress('POST', $params, true);

        return self::handleResponse($response, $enqueue);
    }

    /**
     * Send all logs from the queue.
     *
     * Retry the HTTP calls for the logs that were not sent to the API service
     * because of a connection failure or misconfiguration. Each successful call
     * will remove the log from the queue and the failures will keep them until the
     * next method call is executed.
     */
    public static function sendLogsFromQueue()
    {
        $cache = new SucuriScanCache('auditqueue');
        $entries = $cache->getAll();

        if (is_array($entries) && !empty($entries)) {
            foreach ($entries as $key => $entry) {
                if (self::sendLog($entry->message, $entry->created_at, false)) {
                    $cache->delete($key);
                }
            }
        }
    }

    /**
     * Retrieve the event logs registered by the API service.
     *
     * @param int $lines Maximum number of logs to return.
     * @return array|bool The data structure with the logs.
     */
    public static function getAuditLogs($lines = 50)
    {
        $response = self::apiCallWordpress('GET', array(
            'a' => 'get_logs',
            'l' => $lines,
        ));

        if (!self::handleResponse($response)) {
            return false;
        }

        return self::parseAuditLogs($response);
    }

    /**
     * Gets the security logs from the local server (if enabled).
     *
     * @param int $limit Maximum number of logs to return.
     * @return array|bool The data structure with the logs.
     */
    public static function getSelfHostingLogs($limit = 0)
    {
        if (SucuriScanOption::isDisabled(':selfhosting_monitor')) {
            return self::throwException('Self-hosting monitor is disabled');
        }

        $auditlogs = array();
        $fpath = SucuriScanOption::getOption(':selfhosting_fpath');
        $category = "\x20WordPressAudit\x20" . SucuriScan::getDomain(true);

        if (class_exists('SplFileObject') && is_readable($fpath)) {
            $file = new SplFileObject($fpath);
            $file->seek(PHP_INT_MAX);
            $total = $file->key();
            $offset = $total - $limit;
            $file->seek($offset>0 ? $offset : 0);

            while (!$file->eof()) {
                $line = $file->current();
                $line = str_replace($category, '', $line);
                $line = trim($line); /* remove new line */
                if (!empty($line)) {
                    $auditlogs[] = $line;
                }
                $file->next();
            }
        }

        return self::parseAuditLogs(array(
            'status' => 1,
            'action' => 'get_logs',
            'request_time' => time(),
            'verbose' => 0,
            'output' => array_reverse($auditlogs),
            'total_entries' => count($auditlogs),
        ));
    }

    /**
     * Reads, parses and extracts relevant data from the security logs.
     *
     * @param array $response JSON-decoded logs.
     * @return array Full data extracted from the logs.
     */
    private static function parseAuditLogs($response)
    {
        $response = is_array($response) ? $response : array();
        $response['output_data'] = array();
        $log_pattern = '/^([0-9\-]+) ([0-9:]+) (\S+) : (.+)/';
        $extra_pattern = '/(.+ \(multiple entries\):) (.+)/';
        $generic_pattern = '/^@?([A-Z][a-z]{3,7}): ([^;]+; )?(.+)/';
        $auth_pattern = '/^User authentication (succeeded|failed): ([^<;]+)/';

        foreach ((array) @$response['output'] as $log) {
            if (@preg_match($log_pattern, $log, $log_match)) {
                $log_data = array(
                    'event' => 'notice',
                    'date' => '',
                    'time' => '',
                    'datetime' => '',
                    'timestamp' => 0,
                    'account' => $log_match[3],
                    'username' => 'system',
                    'remote_addr' => '127.0.0.1',
                    'message' => $log_match[4],
                    'file_list' => false,
                    'file_list_count' => 0,
                );

                /* extract and fix the date and time using the Eastern time zone */
                $datetime = sprintf('%s %s EDT', $log_match[1], $log_match[2]);
                $log_data['timestamp'] = strtotime($datetime);
                $log_data['datetime'] = date('Y-m-d H:i:s', $log_data['timestamp']);
                $log_data['date'] = date('Y-m-d', $log_data['timestamp']);
                $log_data['time'] = date('H:i:s', $log_data['timestamp']);

                /* extract more information from the generic audit logs */
                $log_data['message'] = str_replace('<br>', '; ', $log_data['message']);

                if (@preg_match($generic_pattern, $log_data['message'], $log_extra)) {
                    $log_data['event'] = strtolower($log_extra[1]);
                    $log_data['message'] = trim($log_extra[3]);

                    /* extract the username and remote address from the log */
                    if (!empty($log_extra[2])) {
                        $username_address = rtrim($log_extra[2], ";\x20");
                        $log_data['remote_addr'] = $username_address;

                        /* separate the username from the remote address */
                        if (strpos($username_address, ",\x20") !== false) {
                            $usip_parts = explode(",\x20", $username_address, 2);

                            if (count($usip_parts) == 2) {
                                /* separate the username from the display name */
                                $log_data['username'] = @preg_replace('/^.+ \((.+)\)$/', '$1', $usip_parts[0]);
                                $log_data['remote_addr'] = $usip_parts[1];
                            }
                        }
                    }

                    /* fix old user authentication logs for backward compatibility */
                    $log_data['message'] = str_replace(
                        'logged in',
                        'authentication succeeded',
                        $log_data['message']
                    );

                    if (@preg_match($auth_pattern, $log_data['message'], $user_match)) {
                        $log_data['username'] = $user_match[2];
                    }
                }

                /* extract more information from the special formatted logs */
                if (@preg_match($extra_pattern, $log_data['message'], $log_extra)) {
                    $log_data['message'] = $log_extra[1];
                    $log_extra[2] = str_replace(', new size', '; new size', $log_extra[2]);
                    $log_extra[2] = str_replace(",\x20", ";\x20", $log_extra[2]);
                    $log_data['file_list'] = explode(',', $log_extra[2]);
                    $log_data['file_list_count'] = count($log_data['file_list']);
                }

                /* extract additional details from the message */
                if (strpos($log_data['message'], '; details:')) {
                    $idx = strpos($log_data['message'], '; details:');
                    $message = substr($log_data['message'], 0, $idx);
                    $details = substr($log_data['message'], $idx + 11);

                    $log_data['message'] = $message . ' (details):';
                    $log_data['file_list'] = explode(',', $details);
                    $log_data['file_list_count'] = count($log_data['file_list']);
                }

                if ($log_data = self::getLogsHotfix($log_data)) {
                    $response['output_data'][] = $log_data;
                }
            }
        }

        return $response;
    }

    /**
     * Modifies some of the security logs to detail the information.
     *
     * @param array $data Valid security log data structure.
     * @return array|bool Modified security log.
     */
    private static function getLogsHotfix($data)
    {
        /**
         * PHP Compatibility Checker
         *
         * The WP Engine PHP Compatibility Checker can be used by any WordPress
         * website on any web host to check PHP version compatibility. This
         * plugin will lint theme and plugin code inside your WordPress file
         * system and give you back a report of compatibility issues for you to
         * fix.
         *
         * @see https://wordpress.org/plugins/php-compatibility-checker/
         */
        if (isset($data['message'])
            && strpos($data['message'], 'Wpephpcompat_jobs') === 0
            && preg_match('/ID: ([0-9]+); name: (.+)/', $data['message'], $match)
        ) {
            $data['message'] = sprintf(
                'WP Engine PHP Compatibility Checker: %s (created post #%d as cache)',
                $match[2], /* plugin or theme name */
                $match[1] /* unique post or page identifier */
            );
        }

        return $data;
    }

    /**
     * Get a list of valid audit event types with their respective colors.
     *
     * @return array Valid audit event types with their colors.
     */
    public static function getAuditEventTypes()
    {
        return array(
            'critical' => '#000000',
            'debug' => '#c690ec',
            'error' => '#f27d7d',
            'info' => '#5bc0de',
            'notice' => '#428bca',
            'warning' => '#f0ad4e',
        );
    }

    /**
     * Parse the event logs with multiple entries.
     *
     * @param string $event_log Event log that will be processed.
     * @return array List of parts of the event log.
     */
    public static function parseMultipleEntries($event_log = '')
    {
        if (@preg_match('/^(.*:\s)\(multiple entries\):\s(.+)/', $event_log, $match)) {
            $event_log = array();
            $event_log[] = trim($match[1]);
            $grouped_items = @explode(',', $match[2]);
            $event_log = array_merge($event_log, $grouped_items);
        }

        return $event_log;
    }

    /**
     * Collect the information for the audit log report.
     *
     * @param int $lines How many lines from the log file will be retrieved.
     * @return array|bool All the information necessary to display the audit logs report.
     */
    public static function getAuditReport($lines = 50)
    {
        $audit_logs = self::getAuditLogs($lines);

        if (is_array($audit_logs)
            && array_key_exists('total_entries', $audit_logs)
            && array_key_exists('output_data', $audit_logs)
            && !empty($audit_logs['output_data'])
        ) {
            // Data structure that will be returned.
            $report = array(
                'total_events' => 0,
                'start_timestamp' => 0,
                'end_timestamp' => 0,
                'event_colors' => array(),
                'events_per_type' => array(),
                'events_per_user' => array(),
                'events_per_ipaddress' => array(),
                'events_per_login' => array(
                    'successful' => 0,
                    'failed' => 0,
                ),
            );

            // Get a list of valid audit event types.
            $event_types = self::getAuditEventTypes();
            foreach ($event_types as $event => $event_color) {
                $report['events_per_type'][$event] = 0;
                $report['event_colors'][] = $event_color;
            }

            // Collect information for each report chart.
            foreach ($audit_logs['output_data'] as $event) {
                $_username = SucuriScan::escape($event['username']);
                $_remote_addr = SucuriScan::escape($event['remote_addr']);

                @$report['total_events']++;
                @$report['events_per_user'][$_username]++;
                @$report['events_per_type'][$event['event']]++;
                @$report['events_per_ipaddress'][$_remote_addr]++;

                // Find the lowest datetime among the filtered events.
                if ($event['timestamp'] <= $report['start_timestamp']
                    || $report['start_timestamp'] === 0
                ) {
                    $report['start_timestamp'] = $event['timestamp'];
                }

                // Find the highest datetime among the filtered events.
                if ($event['timestamp'] >= $report['end_timestamp']) {
                    $report['end_timestamp'] = $event['timestamp'];
                }

                // Detect successful and failed user authentications.
                if (@preg_match('/^User authentication (succeeded|failed):/', $event['message'], $match)) {
                    if ($match[1] == 'succeeded') {
                        $report['events_per_login']['successful']++;
                    } else {
                        $report['events_per_login']['failed']++;
                    }
                } elseif (@preg_match('/^User logged in:/', $event['message'])) {
                    // Backward compatibility for previous user login messages.
                    $report['events_per_login']['successful']++;
                }
            }

            return $report['total_events'] ? $report : false;
        }

        return false;
    }

    /**
     * Send a request to the API to store and analyze the file's hashes of the site.
     * This will be the core of the monitoring tools and will enhance the
     * information of the audit logs alerting the administrator of suspicious
     * changes in the system.
     *
     * @param string $hashes The information gathered after the scanning of the site's files.
     * @return bool True if the hashes were stored, false otherwise.
     */
    public static function sendHashes($hashes = '')
    {
        if (empty($hashes)) {
            return false;
        }

        $response = self::apiCallWordpress('POST', array(
            'a' => 'send_hashes',
            'h' => $hashes,
        ));

        return self::handleResponse($response);
    }

    /**
     * Generates a new set of WordPress security keys.
     *
     * @return array New set of WordPress security keys.
     */
    public static function getNewSecretKeys()
    {
        $new_keys = array();
        $pattern = self::secretKeyPattern();
        $response = self::apiCall('https://api.wordpress.org/secret-key/1.1/salt/', 'GET');

        if ($response && @preg_match_all($pattern, $response, $match)) {
            foreach ($match[1] as $key => $value) {
                $new_keys[$value] = $match[3][$key];
            }
        }

        return $new_keys;
    }

    /**
     * Retrieve a list with the checksums of the files in a specific version of WordPress.
     *
     * @see Release Archive https://wordpress.org/download/release-archive/
     *
     * @param string|int $version Valid version number of the WordPress project.
     * @return array|bool Associative object with the relative filepath and the checksums of the project files.
     */
    public static function getOfficialChecksums($version = 0)
    {
        $result = false;
        $language = SucuriScanOption::getOption(':language');
        $response = self::apiCall(
            'https://api.wordpress.org/core/checksums/1.0/',
            'GET',
            array(
                'version' => $version,
                'locale' => $language,
            )
        );

        if (is_array($response) && isset($response['checksums'])) {
            $result = isset($response['checksums'][$version])
            ? $response['checksums'][$version]
            : $response['checksums'];
        }

        return $result;
    }

    /**
     * Returns the metadata of all the installed plugins.
     *
     * @see https://developer.wordpress.org/reference/functions/is_plugin_active/
     *
     * @return array List of plugins with associated metadata.
     */
    public static function getPlugins()
    {
        $cache = new SucuriScanCache('plugindata');
        $cached_data = $cache->get('plugins', SUCURISCAN_GET_PLUGINS_LIFETIME, 'array');

        /* use cache data instead of API */
        if ($cached_data) {
            return $cached_data;
        }

        // Get the plugin's basic information from WordPress transient data.
        $plugins = get_plugins();
        $wp_market = 'https://wordpress.org/plugins/%s/';
        $pattern = '/^http(s)?:\/\/wordpress\.org\/plugins\/(.*)\/$/';

        // Loop through each plugin data and complement its information with more attributes.
        foreach ($plugins as $path => $plugin_data) {
            // Default values for the plugin extra attributes.
            $repository = '';
            $repository_name = '';
            $is_free_plugin = false;

            /**
             * Extract the information of the plugin which includes the repository name,
             * repository URL, and if the source code of the plugin is publicly released or
             * not, in this last case if the source code of the plugin is not hosted in the
             * official WordPress server it means that it is premium and is being
             * distributed by an independent developer.
             */
            if (isset($plugin_data['PluginURI'])
                && preg_match($pattern, $plugin_data['PluginURI'], $match)
            ) {
                $repository = $match[0];
                $repository_name = $match[2];
                $is_free_plugin = true;
            } else {
                $delimiter = strpos($path, '/') ? '/' : '.';
                $parts = explode($delimiter, $path, 2);
                $possible_repository = sprintf($wp_market, $parts[0]);
                $resp = wp_remote_head($possible_repository);

                if (!is_wp_error($resp) && $resp['response']['code'] == 200) {
                    $repository = $possible_repository;
                    $repository_name = $parts[0];
                    $is_free_plugin = true;
                }
            }

            // Complement the plugin's information with these attributes.
            $plugins[$path]['Repository'] = $repository;
            $plugins[$path]['RepositoryName'] = $repository_name;
            $plugins[$path]['InstallationPath'] = sprintf('%s/%s', WP_PLUGIN_DIR, $repository_name);
            $plugins[$path]['PluginType'] = ( $is_free_plugin ? 'free' : 'premium' );
            $plugins[$path]['IsPluginInstalled'] = is_dir($plugins[$path]['InstallationPath']);
            $plugins[$path]['IsPluginActive'] = is_plugin_active($path);
            $plugins[$path]['IsFreePlugin'] = $is_free_plugin;
        }

        /* cache data for future usage */
        $cache->add('plugins', $plugins);

        return $plugins;
    }

    /**
     * Retrieve plugin installer pages from WordPress Plugins API.
     *
     * It is possible for a plugin to override the Plugin API result with three
     * filters. Assume this is for plugins, which can extend on the Plugin Info to
     * offer more choices. This is very powerful and must be used with care, when
     * overriding the filters.
     *
     * The first filter, 'plugins_api_args', is for the args and gives the action as
     * the second parameter. The hook for 'plugins_api_args' must ensure that an
     * object is returned.
     *
     * The second filter, 'plugins_api', is the result that would be returned.
     *
     * @param string $plugin Frienly name of the plugin.
     * @return array|bool Object on success, WP_Error on failure.
     */
    public static function getRemotePluginData($plugin = '')
    {
        $url = sprintf('https://api.wordpress.org/plugins/info/1.0/%s.json', $plugin);
        $response = self::apiCall($url, 'GET'); /* ignore plugin existence */
        $response = ($response === 'null') ? false : $response;

        return $response ? $response : false;
    }

    /**
     * Retrieve a specific file from the official WordPress subversion repository,
     * the content of the file is determined by the tags defined using the site
     * version specified. Only official core files are allowed to fetch.
     *
     * @see https://core.svn.wordpress.org/
     * @see https://i18n.svn.wordpress.org/
     * @see https://core.svn.wordpress.org/tags/VERSION_NUMBER/
     *
     * @param string $filepath Relative path of a core file.
     * @param string|int $version Optional Wordpress version number.
     * @return string|bool Original code for the core file, false otherwise.
     */
    public static function getOriginalCoreFile($filepath = '', $version = 0)
    {
        if (empty($filepath)) {
            return false;
        }

        if ($version == 0) {
            $version = self::siteVersion();
        }

        $url = sprintf('https://core.svn.wordpress.org/tags/%s/%s', $version, $filepath);
        $response = self::apiCall($url, 'GET');

        if (strpos($response, '404 Not Found') !== false) {
            return self::throwException('WordPress version is not supported anymore');
        }

        return $response ? $response : false;
    }
}
