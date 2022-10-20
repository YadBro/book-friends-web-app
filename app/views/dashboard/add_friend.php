<div class="container-fluid px-4">
  <div class="row my-5">
    <h3 class="fs-4 mb-3">Add New Friend</h3>
    <div class="col justify-content-center d-flex ">
      <div class="bg-white shadow-sm p-3 rounded my-5" style="width: 90%;">
        <form action="<?= BASE_URL; ?>dashboard/process_add" method="post" autocomplete="off">
          <div class="mb-3">
            <label for="friend_name" class="form-label">Name</label>
            <input type="text" class="form-control" name="friend_name" id="friend_name" placeholder="Andrian" required>
          </div>
          <div class="mb-3">
            <label for="age" class="form-label">Age</label>
            <input type="number" class="form-control" name="age" id="age" min="0" placeholder="15" required>
          </div>
          <div class="mb-3">
            <label for="gender" class="form-label" aria-required="true">Gender</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="gender" id="maleRadio" value="male">
              <label class="form-check-label" for="maleRadio">
                Male
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="gender" id="femaleRadio" value="female">
              <label class="form-check-label" for="femaleRadio">
                Female
              </label>
            </div>
          </div>
          <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>