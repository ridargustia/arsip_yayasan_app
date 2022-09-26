<div class="row">
    <div class="col-lg-12">
        <div class="form-group"><label>Nama Pemesan</label>
            <?php echo form_input($name, $user->name) ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="form-group"><label>Email</label>
            <?php echo form_input($email, $user->email) ?>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group"><label>No. Telephone/HP/WhatsApp</label>
            <?php echo form_input($no_wa, $user->phone) ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="form-group"><label>Alamat</label>
            <?php echo form_input($address, $user->address) ?>
        </div>
    </div>
</div>