<?php require 'header.php'; ?>

<div class="row justify-content-center">

    <div class="col-md-5">

        <div class="card">

            <div class="card-header">

                <h4>Register</h4>

            </div>

            <div class="card-body">

                <form
                    method="POST"
                    action="../app/controllers/AuthController.php?action=register">

                    <div class="mb-3">

                        <label>Nama</label>

                        <input
                            type="text"
                            name="nama"
                            class="form-control"
                            required>

                    </div>

                    <div class="mb-3">

                        <label>Email</label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            required>

                    </div>

                    <div class="mb-3">

                        <label>Password</label>

                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            required>

                    </div>

                    <button
                        type="submit"
                        class="btn btn-success w-100">

                        Register

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

<?php require 'footer.php'; ?>