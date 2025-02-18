@extends('layouts/adminEvent')
@section('container')
    


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dokumen</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xl-6">
            <!-- Horizontal Form -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Dokumen Perlombaan</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/adminEvent/document/store" method="POST" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="event_id" name="event_id" value="{{ $event->event_id }}">
                <div class="card-body">
                  <div class="form-group">
                    <label for="document_name" class="form-label">Nama Dokumen <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('document_name') is-invalid @enderror" id="document_name" name="document_name" value="{{ old('document_name') }}">
                    @error('document_name') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label class="form-label">Dokumen <span class="text-danger">*</span></label>
                    <div class="input-group  @error('document') is-invalid @enderror">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input @error('document') is-invalid @enderror" id="inputGroupFile04" name="document" aria-describedby="inputGroupFileAddon04">
                        <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                      </div>
                    </div>
                    @error('document')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="d-grid gap-2">
                    <button type="submit" name="submit" class="btn btn-primary btn-block">Tambah</button>
                  </div>

                  <hr>
                  @if (count($documents) > 0)
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Document Name</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                          $i = 1;
                      @endphp
                      @foreach ($documents as $document)
                      <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $document->document_name }}</td>
                        <td>
                          <a href="{{ asset('storage/' . $document->document) }}" target="_blank" class="btn btn-primary btn-sm">Download<i class="fa fa-download ml-2" aria-hidden="true"></i></a>
                          <a href="/adminEvent/document/destroy/{{ $document->document_id }}" class="btn btn-danger btn-sm" data-confirm-delete="true">Hapus<i class="fa fa-trash ml-2" aria-hidden="true"></i></a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  @else
                    <p class="text-center">Belum ada data yang tersedia</p>
                  @endif
    
                  
                </div>
                <!-- /.card-body -->
                {{-- <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary float-right">Save</button>
                </div> --}}
                <!-- /.card-footer -->
              </form>
            </div>

            <!-- /.card -->
        </div>

      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script>
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
      const fileName = e.target.files[0]?.name || 'Choose file';
      e.target.nextElementSibling.innerText = fileName;
    });
  </script>

</script>

  @endsection

  