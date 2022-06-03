<div class="row myform">
    <div class="col">
        <table class="table table-2-col">
            <tbody>
                <tr>
                    <td><label>Nomor STR</label></td>
                    <td>
                        <span data-text="true"></span>
                        <span>
                            <input data-editable=true type="text" class="form-control" name="nomor" maxlength="22" value="ADAS2" required="true" />
                        </span>
                    </td>
                </tr>
                <tr>
                    <td><label>Tanggal Terbit</label></td>
                    <td>
                        <span data-text="true"></span>
                        <span>
                            <input data-editable=true type="text" class="form-control datepicker" value="02/01/2022" required="true" />
                        </span>
                    </td>
                </tr>
                <tr>
                    <td><label>Tanggal Expired</label></td>
                    <td>
                        <span data-text="true"></span>
                        <span>
                            <input data-editable=true type="text" class="form-control datepicker" value="02/01/2022" required="true" />
                        </span>
                    </td>
                </tr>
                <tr>
                    <td><label>Peruntukan</label></td>
                    <td>
                        <span data-text="true"></span>
                        <select data-editable=true class="selectpicker" data-style="btn btn-default btn-link input-editable" title="Single Select">
                            <option value="1" selected>Dokter</option>
                            <option value="2">Dokter Anak</option>
                        </select>
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
                <button class="btn btn-primary btn-round btn-fab" onclick="openHistoriSTR()">
                    <i class="material-icons">pending_actions</i>
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
<div class="btn-selengkapnya-wrapper d-absolute w-100 text-center">
    <button type="button" class="btn btn-primary btn-selengkapnya"><i
            class="material-icons">priority_high</i> TINDAKAN PADA STR</button>
</div>