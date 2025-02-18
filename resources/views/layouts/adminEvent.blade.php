<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tanding</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  {{-- <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css"> --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="/plugins/summernote/summernote-bs4.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

  <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
  <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>

  <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
  <link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css">

  <link rel="stylesheet" href="/css/jquery.bracket-world.css" type="text/css" media="all">

  <style>


.bracket-container {
    width: 100%;
    overflow-x: auto; /* Scroll secara horizontal jika bagan terlalu besar */
    padding-bottom: 10px; /* Tambahan padding agar tidak terpotong */
}

.bracket-wrapper {
    display: flex;
    justify-content: center;
    width: 100%;
    margin-bottom: 50px;
    /* position: relative; */
}

/* Saat layar kecil (max-width: 640px), ubah posisi ke kiri */
@media (max-width: 640px) {
    .bracket-wrapper {
        justify-content: flex-start;
        padding-left: 10px; /* Tambahkan sedikit padding agar tidak menempel ke tepi */
    }
}

.bracket {
    display: flex;
    flex-direction: row;
    gap: 20px;
    align-items: center; /* Pastikan round title tetap di atas */
}

.round {
    display: flex;
    flex-direction: column;
    gap: 10px;
    padding: 15px;
    margin: 15px;
    border-left: 2px dashed #bbbbbb;
    border-right: 2px dashed #bbb;
    background: #fff;
    padding-bottom: 20px;
    border-radius: 10px;
}

.round h4 {
    text-align: center;
    font-size: 16px;
    font-weight: bold;
    margin-bottom: 10px;
}

.match-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 10px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    text-align: center;
    width: 250px;
    border: 1px solid #000;
    margin: 10px auto;
}

.match-number {
    font-weight: bold;
    color: #333;
    margin-bottom: 5px;
}

.match-participant {
    font-weight: bold;
}

.match-participant span {
    font-weight: bold;
}

.blue {
    color: blue;
}

.red {
    color: red;
}

.vs-text {
    font-size: 14px;
    font-weight: bold;
    margin: 5px 0;
}

.winner {
    margin-top: 8px;
    font-size: 14px;
    color: #000;
    font-weight: normal;
}

.loser {
    text-decoration: line-through;
    color: gray !important; /* Warna jadi abu-abu untuk memperjelas kekalahan */
    opacity: 0.6;
}

.bracket-lines {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
}

</style>


  
  {{-- <script src="https://cdn.printjs.crabbly.com/print.min.js"></script> --}}

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->
  
  @include('partials.adminEventNav')
  @yield('container')

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <!-- Default to the left -->
    <strong>Copyright &copy; {{ date("Y"); }} Tanding.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="/plugins/jszip/jszip.min.js"></script>
<script src="/plugins/pdfmake/pdfmake.min.js"></script>
<script src="/plugins/pdfmake/vfs_fonts.js"></script>
<script src="/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@include('sweetalert::alert')

<!-- SweetAlert2 -->
<script src="/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Select2 -->
<script src="/plugins/select2/js/select2.full.min.js"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
  
  $(function () {
  $("#example2").DataTable({
    "responsive": true, 
    "lengthChange": false, 
    "autoWidth": false, 
    // "order": [[0, 'desc']],
    "buttons": [
      {
        extend: 'csv',
      },
      {
        extend: 'excel',
      },
      {
        extend: 'pdf',
        orientation: 'landscape',
        pageSize: 'A4',
        customize: function(doc) {
            doc.defaultStyle.alignment = 'left';
            // Lebih banyak kustomisasi bisa ditambahkan di sini

            // Iterasi melalui setiap header cell dan mengubah style
            doc.content[1].table.body[0].forEach(function(header) {
                header.alignment = 'left'; // Mencoba mengatur alignment header ke kiri
            });
        }
      },
      {
        extend: 'print',
        // Customize untuk print
        customize: function (win) {
            $(win.document.body)
                .css('font-size', '10pt');
            $(win.document.body).find('table')
                .addClass('compact')
                .css('font-size', 'inherit');

            // Menambahkan CSS untuk mengatur orientasi saat print
            var css = '@page { size: landscape; }',
                head = win.document.head || win.document.getElementsByTagName('head')[0],
                style = win.document.createElement('style');

            style.type = 'text/css';
            style.media = 'print';

            if (style.styleSheet){
              style.styleSheet.cssText = css;
            } else {
              style.appendChild(win.document.createTextNode(css));
            }

            head.appendChild(style);
        }
      },
      {
        extend: 'colvis',
      }
    ]
  }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
});

</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  })
</script>
<script>
  $(function() {
    $('.swalDefaultSuccess').click(function() {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            title: "Deleted!",
            text: "Your file has been deleted.",
            icon: "success"
          });
        }
      });
    });
  });
</script>
</body>
</html>
