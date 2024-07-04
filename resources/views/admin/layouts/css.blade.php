  <!-- Favicons -->
  <link href="{{ url('assets/homepage/img/amartafav.png') }}" rel="icon">
  <link href="{{ url('assets/homepage/img/amartafav.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
      rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ url('assets/admin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ url('assets/admin/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ url('assets/admin/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ url('assets/admin/vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ url('assets/admin/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ url('assets/admin/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ url('assets/admin/vendor/simple-datatables/style.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ url('assets/admin/css/style.css') }}" rel="stylesheet">
  @notifyCss
  <style type="text/css">
      .notify {
          z-index: 1000000;
          position: fixed;
          right: 20px;
          top: 20px;
          margin-top: 0;
          background-color: #f8d7da;
          /* Change this to suit your needs */
          color: #721c24;
          /* Change this to suit your needs */
          padding: 15px;
          border-radius: 5px;
          box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      }

      .notify.success {
          background-color: #d4edda;
          color: #155724;
      }

      .notify.info {
          background-color: #cce5ff;
          color: #004085;
      }

      .notify.warning {
          background-color: #fff3cd;
          color: #856404;
      }

      .notify.error {
          background-color: #f8d7da;
          color: #721c24;
      }
  </style>
