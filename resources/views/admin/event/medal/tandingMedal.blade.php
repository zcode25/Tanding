@extends('layouts.adminEvent')

@section('container')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                    <h1 class="mb-2">Perolehan Medali</h1>
                    <p>{{ $category->category_name }} / {{ $age->age_name }} / {{ $competition->gender }} / {{ $matchclass->class_name }} ({{ $matchclass->class_min }}Kg s/d {{ $matchclass->class_max }}Kg)</p>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xl-12">
              <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Perolehan Medali</h3>
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
                                <th>Format</th>
                                <th>Total Peserta</th>
                                <th>Total Pool</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($brackets as $bracket)
                            <tr>
                              <td>{{ $bracket->format }}</td>
                              <td>{{ $bracket->total_participants }}</td>
                              @if ($bracket->total_pools)
                                <td>{{ $bracket->total_pools }}</td>
                              @else
                                <td>-</td>
                              @endif
                              
                              <td class="py-0 align-middle">
                                <a href="/adminMedal/medal/participant/{{ $bracket->bracket_id }}" class="btn btn-dark btn-sm">Detail<i class="fa fa-eye ml-2" aria-hidden="true"></i></a>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>
              </div>
            </div>

            
        </div>
    </section>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const formatSelect = document.getElementById("format");
        const poolGroup = document.getElementById("pool-group");

        function togglePoolInput() {
            poolGroup.style.display = formatSelect.value === "Pool" ? "block" : "none";
        }

        togglePoolInput();
        formatSelect.addEventListener("change", togglePoolInput);
    });
</script>
@endsection
