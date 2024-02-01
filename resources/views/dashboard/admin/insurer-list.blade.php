@extends('dashboard/layouts/dashboard-layout')
@section('main-section')
<!-- partial -->

  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
          <i class="mdi mdi-account-card-details"></i>
        </span>Insurers
      </h3>

    </div>
    <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body table-responsive">
          <h4 class="card-title">Insurer Table</h4>
          
          <table id='insurer' class="table table-striped">
          <div class="row">
            <div class="col-4">
              <div class="form-group">
                <label for="exampleFormControlSelect3">Buisness Line</label>
                <select class="form-control form-control-sm" name="filterbypreffered_line" id="filterbypreffered_line">
                  <option value="" selected disabled>--Select options--</option>
                  <option value="">All</option>
                  <option value="life">Life</option>
                  <option value="general">General</option>
                  <option value="health">Health</option>
                  <option value="other">Other</option>
                </select>
              </div>

            </div>
          </div>
            <div class="form-sample">
            </div>
            <thead class="">
              <tr>
                <th class="">Sr. No</th>
                <th class="">Name</th>
                <th class="">Email</th>
                <th class="">Phone</th>
                <th class="">Buisness Line</th>

                <th class="text-center">Actions</th>
              </tr>
            </thead>
          </table>
          <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
          <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
          <script type="text/javascript">
            $(document).ready(function() {
              // Declare table variable in a wider scope
              var table = $('#insurer').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                  url: "{{ route('getInsurerTableData') }}",
                  data: function(d) {
                    var preffered_lineFilter = document.getElementById('filterbypreffered_line');
                    d.filter_Line = preffered_lineFilter.value;
                    return d;
                  }
                },
                columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: true,
                    searchable: false,
                    className: 'text-center'
                  },
                  {
                    data: 'name',
                    render: function(data, type, row) {
                      // Truncate names longer than 9 characters
                      return data.length > 9 ? data.substring(0, 9) + '...' : data;
                    }
                  },
                  {
                    data: 'email',
                    render: function(data, type, row) {
                      // Truncate names longer than 9 characters
                      return data.length > 20 ? data.substring(0, 20) + '...' : data;
                    }
                  },
                  {
                    data: 'phone'
                  },
                  {
                    data: 'profile', // Corrected the property name
                    render: function(data, type, row) {
                      var capitalizedLine = data.preffered_line?.charAt(0).toUpperCase() + data.preffered_line.slice(1);
                      return capitalizedLine.length > 9 ? capitalizedLine.substring(0, 9) + '...' : capitalizedLine;
                    }
                  },
                  {
                    data: 'actions',
                    orderable: false,
                    searchable: false
                  },
                ],
                createdRow: function(row, data, dataIndex) {
                  // Apply custom styles to the 'actions' column
                  var actionsColumn = $(row).find('td:eq(5)');
                  actionsColumn.addClass('custom-actions');
                }
              });
              $('#filterbypreffered_line').on('change', function() {
                // Reload the DataTable when the filter value changes
                table.ajax.reload();
              });
            });
          </script>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection