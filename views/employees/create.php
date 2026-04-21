<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Yeni Employee</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="/store">
                    <div class="mb-3">
                        <label class="form-label">Ad</label>
                        <input type="text" name="first_name" class="form-control" placeholder="Ad" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Soyad</label>
                        <input type="text" name="last_name" class="form-control" placeholder="Soyad" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Telefon</label>
                        <input type="text" name="phone" class="form-control" placeholder="Telefon">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Vəzifə</label>
                        <input type="text" name="position" class="form-control" placeholder="Vəzifə">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Maaş</label>
                        <input type="number" step="0.01" name="salary" class="form-control" placeholder="Maaş">
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="/" class="btn btn-secondary">Geri</a>
                        <button type="submit" class="btn btn-primary">Yadda saxla</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>