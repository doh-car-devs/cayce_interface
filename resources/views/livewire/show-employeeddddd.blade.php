<div>
    <input wire:model="search" type="text" placeholder="Search users..." class="form-control container p-2"/>

    <div class="card container">
        <div class="card-body">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">NAME</th>
                        <th scope="col">NAME</th>
                        <th scope="col">Address</th>
                        <th scope="col">Number</th>
                        <th scope="col">Temp</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <th>{{ $user->id }}</th>
                            <th>{{ $user->first_name }}</th>
                            <th>{{ $user->second_name }}</th>
                            <th>{{ $user->address }}</th>
                            <th>{{ $user->contact_number }}</th>
                            <th>{{ $user->temp }}</th>
                            <th>{{ $user->time }}</th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $users->links() }}
        </div>
    </div>
</div>
