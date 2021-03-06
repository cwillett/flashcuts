
<div class="sucuriscan-tabs">
    <ul class="sucuriscan-clearfix sucuriscan-tabs-buttons">
        <li><a href="%%SUCURI.URL.Settings%%#general">@@SUCURI.General@@</a></li>
        <li><a href="%%SUCURI.URL.Settings%%#scanner">@@SUCURI.Scanner@@</a></li>
        <li><a href="%%SUCURI.URL.Settings%%#hardening">@@SUCURI.Hardening@@</a></li>
        <li><a href="%%SUCURI.URL.Settings%%#posthack">@@SUCURI.PostHack@@</a></li>
        <li><a href="%%SUCURI.URL.Settings%%#alerts">@@SUCURI.Alerts@@</a></li>
        <li><a href="%%SUCURI.URL.Settings%%#apiservice">@@SUCURI.APICommunication@@</a></li>
        <li><a href="%%SUCURI.URL.Settings%%#webinfo">@@SUCURI.WebsiteInfo@@</a></li>
    </ul>

    <div class="sucuriscan-tabs-containers">
        <div id="sucuriscan-tabs-general">
            %%%SUCURI.Settings.General.ApiKey%%%

            %%%SUCURI.Settings.General.DataStorage%%%

            %%%SUCURI.Settings.General.SelfHosting%%%

            %%%SUCURI.Settings.General.Cronjobs%%%

            %%%SUCURI.Settings.General.ReverseProxy%%%

            %%%SUCURI.Settings.General.IPDiscoverer%%%

            %%%SUCURI.Settings.General.CommentMonitor%%%

            %%%SUCURI.Settings.General.AuditLogStats%%%

            %%%SUCURI.Settings.General.ImportExport%%%

            %%%SUCURI.Settings.General.ResetOptions%%%
        </div>

        <div id="sucuriscan-tabs-scanner">
            %%%SUCURI.Settings.Scanner.Options%%%

            %%%SUCURI.Settings.Scanner.IntegrityDiffUtility%%%

            %%%SUCURI.Settings.Scanner.IntegrityLanguage%%%

            %%%SUCURI.Settings.Scanner.IntegrityCache%%%

            %%%SUCURI.Settings.Scanner.IgnoreFolders%%%
        </div>

        <div id="sucuriscan-tabs-hardening">
            <div class="sucuriscan-panel">
                <h3 class="sucuriscan-title">Hardening Options</h3>

                <div class="inside">
                    %%%SUCURI.Settings.Hardening.Firewall%%%

                    %%%SUCURI.Settings.Hardening.WPVersion%%%

                    %%%SUCURI.Settings.Hardening.PHPVersion%%%

                    %%%SUCURI.Settings.Hardening.RemoveGenerator%%%

                    %%%SUCURI.Settings.Hardening.NginxPHPFPM%%%

                    %%%SUCURI.Settings.Hardening.WPUploads%%%

                    %%%SUCURI.Settings.Hardening.WPContent%%%

                    %%%SUCURI.Settings.Hardening.WPIncludes%%%

                    %%%SUCURI.Settings.Hardening.Readme%%%

                    %%%SUCURI.Settings.Hardening.AdminUser%%%

                    %%%SUCURI.Settings.Hardening.FileEditor%%%
                </div>
            </div>

            %%%SUCURI.Settings.Hardening.WhitelistPHPFiles%%%
        </div>

        <div id="sucuriscan-tabs-posthack">
            %%%SUCURI.Settings.Posthack.SecurityKeys%%%

            %%%SUCURI.Settings.Posthack.ResetPassword%%%

            %%%SUCURI.Settings.Posthack.ResetPlugins%%%

            %%%SUCURI.Settings.Posthack.AvailableUpdates%%%
        </div>

        <div id="sucuriscan-tabs-alerts">
            %%%SUCURI.Settings.Alerts.Recipients%%%

            %%%SUCURI.Settings.Alerts.TrustedIPs%%%

            %%%SUCURI.Settings.Alerts.Subject%%%

            %%%SUCURI.Settings.Alerts.PerHour%%%

            %%%SUCURI.Settings.Alerts.BruteForce%%%

            %%%SUCURI.Settings.Alerts.Events%%%

            %%%SUCURI.Settings.Alerts.IgnorePosts%%%
        </div>

        <div id="sucuriscan-tabs-apiservice">
            %%%SUCURI.Settings.APIService.Status%%%

            %%%SUCURI.Settings.APIService.Timeout%%%

            %%%SUCURI.Settings.APIService.Proxy%%%
        </div>

        <div id="sucuriscan-tabs-webinfo">
            %%%SUCURI.Settings.Webinfo.Details%%%

            %%%SUCURI.Settings.Webinfo.WPConfig%%%

            %%%SUCURI.Settings.Webinfo.HTAccess%%%
        </div>
    </div>
</div>
