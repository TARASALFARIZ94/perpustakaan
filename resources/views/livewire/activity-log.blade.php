<div>
    <h4>Activity Log</h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Date</th>
                <th>Action</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($logs as $log)
                <tr>
                    <td>{{ $log['date'] }}</td>
                    <td>{{ $log['action'] }}</td>
                    <td>{{ $log['details'] }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No activity logs available.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>