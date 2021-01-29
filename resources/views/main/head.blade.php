<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/drawer/3.2.2/css/drawer.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/iScroll/5.2.0/iscroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/drawer/3.2.2/js/drawer.min.js"></script>
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>

  <!-- cssは移設しました -->
  <script src="{{ asset('/js/main.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('styles/main.css') }}">
  <link rel="stylesheet" href="{{ asset('styles/sidebar.css') }}">

  <script type="text/x-template" id="dropdown-template">
    <div id="dropdown-container" class="v-dropdown-container">
      <ul class="v-dropdown-list">
        <a class="nav-link v-dropdown-item" href="/user/signin">sign in</a>
        <a class="nav-link v-dropdown-item" href="/user/signout">sign out</a>
        <a class="nav-link v-dropdown-item v-dropdown-item-last" href="/user/{{ Auth::id() }}/summary/account">setting</a>
      </ul>
    </div>
  </script>
</head>
