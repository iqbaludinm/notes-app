<table class="table table-borderless table-nowrap table-hover table-centered m-0">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>E-mail</th>
            <th>Level</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as$no =>  $user )
        <tr>
            <td>
                {{$no + $data->firstItem()}}
            </td>
            <td>
                <h5 class="m-0 font-weight-normal">{{$user->name}}</h5>
            </td>
            <td>
                {{$user->email}}
            </td>

            <td>
                @foreach ($user->roles as $r )
                {{$r->display_name}}
                @endforeach
            </td>
            <td>
                {{$user->created_at}}
            </td>
            <td>
                <a href="{{route('users.detail',['id' => $user->slug])}}" class="action-icon" title="Detail"> <i class="mdi mdi-eye"></i></a>
            </td>

        </tr>
        @endforeach
    </tbody>
</table>
