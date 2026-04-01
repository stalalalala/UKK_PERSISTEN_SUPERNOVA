<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #4A72D4; padding-bottom: 10px; }
        .title { font-size: 18px; font-weight: bold; color: #4A72D4; text-transform: uppercase; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f8fafc; font-weight: bold; }
        .meta { margin-bottom: 5px; font-size: 10px; color: #666; }
        .category { font-weight: bold; color: #4A72D4; text-transform: uppercase; font-size: 9px; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">PERSISTEN - MONITORING RINCI</div>
        <p>{{ $title }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="15%">Waktu</th>
                <th width="20%">Admin</th>
                <th>Aktivitas & Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
            <tr>
                <td>
                    <strong>{{ $log->created_at->isoFormat('dddd') }}</strong><br>
                    <span style="font-size: 10px">{{ $log->created_at->format('H:i') }}</span>
                </td>
                <td>{{ $log->user->name ?? 'System' }}</td>
                <td>
                    <div class="category">{{ $log->category }}</div>
                    <strong>{{ $log->title }}</strong><br>
                    <span style="color: #666; font-style: italic;">{{ $log->description }}</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>