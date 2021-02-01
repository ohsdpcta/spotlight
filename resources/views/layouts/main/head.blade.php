<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/drawer/3.2.2/css/drawer.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/iScroll/5.2.0/iscroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/drawer/3.2.2/js/drawer.min.js"></script>
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

  <!-- cssは移設しました -->
  <script src="{{ asset('/js/main.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('styles/main.css') }}">
  <link rel="stylesheet" href="{{ asset('styles/sidebar.css') }}">

  <script type="text/x-template" id="dropdown-template">
    <div class="v-dropdown-container">
      <ul class="v-dropdown-list">
        <a class="nav-link v-dropdown-item" href="/user/signin">sign in</a>
        <a class="nav-link v-dropdown-item" href="/user/signout">sign out</a>
        <a class="nav-link v-dropdown-item v-dropdown-item-last" href="/user/{{ Auth::id() }}/summary/account">setting</a>
      </ul>
    </div>
  </script>
</head>
