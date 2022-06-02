<div class="row myform">
    <div class="col">
        <table class="table table-2-col td-30">
            <tbody>
                <tr>
                    <td><label>NIK</label></td>
                    <td>
                        <span data-text="true"></span>
                        <span>
                            <input data-editable=true type="text" class="form-control" name="nik" maxlength="16" value="3578273503990001" required="true" />
                        </span>
                    </td>
                </tr>
                <tr>
                    <td><label>Nama</label></td>
                    <td>
                        <span data-text="true"></span>
                        <span>
                            <input data-editable=true type="text" class="form-control" name="nama" maxlength="30" value="RM IVAN INDRAKUSUMA" required="true" />
                        </span>
                    </td>
                </tr>
                <tr>
                    <td><label>Tempat Lahir</label></td>
                    <td>
                        <span data-text="true"></span>
                        <span>
                            <input data-editable=true type="text" class="form-control" name="tempatlahir" maxlength="20" value="SURABAYA" required="true" />
                        </span>
                    </td>
                </tr>
                <tr>
                    <td><label>Tanggal Lahir</label></td>
                    <td>
                        <span data-text="true"></span>
                        <span>
                            <input data-editable=true type="text" class="form-control datepicker" name="tanggallahir" value="02/01/2022" required="true" />
                        </span>
                    </td>
                </tr>
                <tr>
                    <td><label>Jenis Kelamin</label></td>
                    <td>
                        <span data-text="true"></span>
                        <select data-editable=true class="selectpicker" name="jeniskelamin"  data-style="btn btn-default btn-link input-editable" title="Single Select">
                            <option value="L" selected>LAKI-LAKI</option>
                            <option value="P">PEREMPUAN</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Perguruan Tinggi</label></td>
                    <td>
                        <span data-text="true"></span>
                        <span>
                            <input data-editable=true type="text" class="form-control" name="perguruantinggi" value="UNAIR" required="true" />
                        </span>
                    </td>
                </tr>
                <tr>
                    <td><label>Tahun Lulus</label></td>
                    <td>
                        <span data-text="true"></span>
                        <span>
                            <input data-editable=true type="text" class="form-control" name="tahunlulus" value="2017" required="true" />
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col" style="flex-grow:0;">
        <div class="float-right absolute myform-actions">
            <div data-state="0" class="anim slide">
                <button class="btn btn-primary btn-round btn-fab" onclick="$(this).myFormAndToggle().toggle(1)">
                    <i class="material-icons">edit_note</i>
                </button>
            </div>
            <div data-state="1" class="anim slide">
                <button class="btn btn-danger btn-round btn-fab" onclick="$(this).myFormAndToggle().toggle(0)">
                    <i class="material-icons">close</i>
                </button>
                <button class="btn btn-success btn-round btn-fab">
                    <i class="material-icons">save</i>
                </button>
            </div>
        </div>
    </div>
</div>