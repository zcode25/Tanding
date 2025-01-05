@extends('layouts/adminEvent')
@section('container')
    


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Event Information</h1>
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
                <h3 class="card-title">Form Information Event</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/adminEvent/information/store" method="POST" class="form-horizontal">
                @csrf
                <input type="hidden" id="event_id" name="event_id" value="{{ $event->event_id }}">
                <div class="card-body">
                  <div class="form-group">
                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $information->title ?? '') }}">
                    @error('title') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="description" class="form-label">Description<span class="text-danger">*</span></label>
                    <input id="description" 
                           class="@error('description') is-invalid @enderror" 
                           type="hidden" 
                           name="description" 
                           value="{{ old('description', $information->description ?? '') }}">
                    <trix-editor input="description"></trix-editor>
                    @error('description') 
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="open_reg" class="form-label">Open Registration<span class="text-danger">*</span></label>
                    <input type="date" class="form-control @error('open_reg') is-invalid @enderror" id="open_reg" name="open_reg" value="{{ old('open_reg', $information->open_reg ?? '') }}">
                    @error('open_reg') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="close_reg" class="form-label">Close Registration<span class="text-danger">*</span></label>
                    <input type="date" class="form-control @error('close_reg') is-invalid @enderror" id="close_reg" name="close_reg" value="{{ old('close_reg', $information->close_reg ?? '') }}">
                    @error('close_reg') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="start_match" class="form-label">Start Match<span class="text-danger">*</span></label>
                    <input type="date" class="form-control @error('start_match') is-invalid @enderror" id="start_match" name="start_match" value="{{ old('start_match', $information->start_match ?? '') }}">
                    @error('start_match') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="end_match" class="form-label">End Match<span class="text-danger">*</span></label>
                    <input type="date" class="form-control @error('end_match') is-invalid @enderror" id="end_match" name="end_match" value="{{ old('end_match', $information->end_match ?? '') }}">
                    @error('end_match') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class=" form-group">
                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                    <select class="form-control select2bs4 @error('status') is-invalid @enderror" id="status" name="status" data-placeholder="Select a Status">
                      <option value=""></option>
                      @foreach ($statuses as $status)
                        @if (old('status', $information->status ?? '') == $status['status'])
                          <option value="{{ $status['status'] }}" selected>{{ $status['status'] }}</option>
                        @else
                          <option value="{{ $status['status'] }}">{{ $status['status'] }}</option>
                        @endif
                      @endforeach
                    </select>
                    @error('status') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary float-right">Save</button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>

            <!-- /.card -->
        </div>
        <div class="col-xl-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Form Banner Event</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="/adminEvent/banner/store" method="POST" enctype="multipart/form-data"  class="form-horizontal">
              @csrf
              <input type="hidden" id="event_id" name="event_id" value="{{ $event->event_id }}">
              <div class="card-body">
                <div class="form-group">
                  <label class="form-label">Banner Image<span class="text-danger">*</span></label>
                  <div class="input-group  @error('banner_img') is-invalid @enderror">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input @error('banner_img') is-invalid @enderror" id="inputGroupFile04" name="banner_img" aria-describedby="inputGroupFileAddon04">
                      <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                    </div>
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="submit" name="submit" id="inputGroupFileAddon04">Upload</button>
                    </div>
                  </div>
                  @error('banner_img')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                @foreach ($banners as $banner)
                  <div class="image-container mb-3">
                    <img src="{{ asset('storage/' . $banner->banner_img) }}" class="img-fluid" alt="Image">
                    <a href="/adminEvent/banner/destroy/{{ $banner->banner_id }}" class="btn btn-danger btn-sm btn-block" data-confirm-delete="true">Remove</a>
                  </div>
                @endforeach
              </div>
            </form>
            
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

  