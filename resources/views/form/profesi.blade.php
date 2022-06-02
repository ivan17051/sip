<div class="row myform">
    <div class="col">
        <table class="table table-2-col td-30">
            <tbody>
                <tr>
                    <td><label>Nomor STR</label></td>
                    <td>1029 0120 3023</td>
                </tr>
                <tr>
                    <td><label>Tanggal Terbit</label></td>
                    <td>2 Januari 2022</td>
                </tr>
                <tr>
                    <td><label>Tanggal Expired</label></td>
                    <td><strong class="text-danger">2 Januari 2027</strong></td>
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