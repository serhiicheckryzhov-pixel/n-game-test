<x-app-layout>
    <div class="flex flex-col items-center justify-center overflow-y-auto overflow-x-auto">
        <div class="overflow-x-auto">
            <table class="table table-zebra">
                <!-- head -->
                <thead>
                <tr>
                    <th></th>
                    <th>Income</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach($results as $result)
                <tr>
                    <th>{{ $loop->iteration }}</th>
                    <td>{{ $result->income }}</td>
                    <td>{{ $result->created_at }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
