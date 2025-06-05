<?php
  // check if the user is not an admin
  if ( !isAdmin() ) {
    header("Location: /dashboard");
    exit;
  }
?>

<?php require "parts/header.php"; ?>

<h1 class="h1">Change Password</h1>
<div class="containeh mx-auto my-5" style="max-width: 700px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
      </div>
      <div class="cared mb-2 p-4">
        <form method="POST" action="/user/changepwd">
          <div class="mb-3">
            <div class="row">
              <div class="col">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" />
              </div>
              <div class="col">
                <label for="confirm-password" class="form-label"
                  >Confirm Password</label
                >
                <input
                  type="password"
                  class="form-control"
                  id="confirm-password"
                  name="confirm_password"
                />
              </div>
            </div>
          </div>
          <div class="d-grid">
            <!-- pass the id to the action route for changing the password -->
            <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>" />
            <button type="submit" class="btn btn-primary">
              Change Password
            </button>
          </div>
        </form>
      </div>
      <div class="text-center">
        <a href="/manage-users" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back to Users</a
        >
      </div>
    </div>

