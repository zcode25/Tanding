@extends('layouts/adminEvent')
@section('container')
    


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Kompetisi</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xl-4">
            <!-- Horizontal Form -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Pertandingan</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/adminEvent/competition/store" method="POST" class="form-horizontal">
                @csrf
                <input type="hidden" id="event_id" name="event_id" value="{{ $event->event_id }}">
                <div class="card-body">
                  <div class=" form-group">
                    <label for="category_id" class="form-label">Kategori Pertandingan <span class="text-danger">*</span></label>
                    <select class="form-control select2bs4 @error('category_id') is-invalid @enderror" id="category_id" name="category_id" data-placeholder="Pilih Kategori Pertandingan">
                      <option value=""></option>
                      @foreach ($categories as $category)
                        @if (old('category_id') == $category->category_id)
                          <option value="{{ $category->category_id }}" selected>{{ $category->category_name }} ({{ $category->category_type }} - {{ $category->category_amount }})</option>
                        @else
                          <option value="{{ $category->category_id }}">{{ $category->category_name }} ({{ $category->category_type }} - {{ $category->category_amount }})</option>
                        @endif
                      @endforeach
                    </select>
                    @error('status') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class=" form-group">
                    <label for="age_id" class="form-label">Kategori Umur <span class="text-danger">*</span></label>
                    <select class="form-control select2bs4 @error('age_id') is-invalid @enderror" id="age_id" name="age_id" data-placeholder="Pilih Kategori Umur">
                      <option value=""></option>
                      @foreach ($ages as $age)
                        @if (old('age_id') == $age->age_id)
                          <option value="{{ $age->age_id }}" selected>{{ $age->age_name }}</option>
                        @else
                          <option value="{{ $age->age_id }}">{{ $age->age_name }}</option>
                        @endif
                      @endforeach
                    </select>
                    @error('age_group') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="price" class="form-label">Harga <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}">
                    @error('price') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="d-grid gap-2">
                    <button type="submit" name="submit" class="btn btn-primary btn-block">Tambah</button>
                  </div>


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
        <div class="col-xl-8">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Daftar Perlombaan</h3>
    
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <table id="example1" class="table table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kategori Pertandingan</th>
                    <th>Kategori Umur</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                      $i = 1;
                  @endphp
                  @foreach ($competitions as $competition)
                  <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $competition->category->category_name }} ({{ $competition->category->category_type }} - {{ $competition->category->category_amount }})</td>
                    <td>{{ $competition->age->age_name }}</td>
                    <td>Rp {{ number_format($competition->price, 0, ',', '.') }}</td>
                    <td>
                      {{-- <a href="{{ asset('storage/' . $document->document) }}" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-download" aria-hidden="true"></i></a> --}}
                      <a href="/adminEvent/competition/destroy/{{ $competition->competition_id }}" class="btn btn-danger btn-sm" data-confirm-delete="true">Hapus<i class="fa fa-trash ml-2" aria-hidden="true"></i></a>
                    </td>
                  </tr>
                  @endforeach
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          
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

  