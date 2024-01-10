<!-- Simplicity is the consequence of refined emotions. - Jean D'Alembert -->
<!-- @foreach($data as $row)
                          
                          <tr>
                          <th>{{$row->id}}</th>
                          <th>{{$row->name}}</th>
                          <th>{{$row->email}}</th>
                          <th>{{$row->phone}}</th>
                          <th class="text-center">Action</th>
                        </tr>
                        @endforeach -->
<table class="table table-striped">
  <thead>
    <tr>
      <th>Sr.No</th>
      <th> Name </th>
      <th>Email</th>
      <th>Phone</th>
      <th class="text-center">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php $i = 1; ?>
    @foreach($data as $row)
    <tr>
      <td>{{$i++}}

      </td>
      <td> {{$row->name}}</td>
      <td>{{$row->email}}</td>
      <td>{{$row->phone}}</td>

      <td style="display: flex; gap:10px" class="text-center">
        @if(Auth::user()->hasRole('Superadmin') || Auth::user()->can('view_candidate_details') || Auth::user()->can('view_users_details') )
        <a href="/admin/user/{{$row->user_id}}" class="btn btn-sm btn-gradient-success btn-rounded">View</a>
        @endif
        
        @hasrole('Superadmin')
        <a  class="btn btn-sm btn-gradient-warning btn-rounded editButton"  data-user-id="{{$row->user_id}}">Edit</a>

        <form  id="candidate-delete-form" action="admin/user/{{$row->user_id}}" method="POST" >
          @csrf
          @method('DELETE')
          <button style="" type="submit" href="profile.html" class="btn btn-sm btn-gradient-danger btn-rounded " onclick="deleteAlert()">Delete</button>
        </form>
        @endhasrole

      </td>
    </tr>

    @endforeach
  </tbody>
</table>