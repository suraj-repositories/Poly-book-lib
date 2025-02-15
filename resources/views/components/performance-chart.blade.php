<div
    id="dash-performance-chart"
    class="apex-charts"
    data-downloads-monthly="{{ json_encode($downloadMonthyRecord) }}"
    data-users-monthly="{{ json_encode($usersMonthyRecord) }}"
    data-downloads-halfmonthly="{{ json_encode($halfMonthlyDownloads) }}"
    data-users-halfmonthly="{{ json_encode($halfMonthlyUsers) }}"
    data-users-yearly="{{ json_encode($yearlyUsers) }}"
    data-downloads-yearly="{{ json_encode($yearlyDownloads) }}"
    data-downloads-daily="{{ json_encode($dailyDownloads) }}"
    data-users-daily="{{ json_encode($dailyUsers) }}"
></div>
