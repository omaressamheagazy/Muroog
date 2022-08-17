<?php

use App\Helpers\Enums\MessagesName;
use App\Helpers\Enums\MessageType;
use App\Helpers\MessageReporting;

 include INC_BACKEND . "/header.php";?>
<?php include INC_BACKEND . "/navbar.php";?>
<?php include INC_BACKEND . "/sidebar.php";?>
<br>
<center>
    <h1><?=$data["title"]?></h1>
</center>
<br>
<div class="row m-5">
  <div class="table-responsive " style="width:80%; margin-left:18%">
  <?php MessageReporting::flash(MessagesName::LOCATION) ?>
                    <table id="dtBasicExample" class="table table-striped table-bordered table-lg table-hover table-condensed" cellspacing="0" width="100%">
                      <thead class="black white-text" >
                        <tr>
                          <th class="th-sm">#</th>
                          <th class="th-lg">Location</th>
                          <th class="th-sm">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($data["location"] as $key => $location): ?>
                        <tr>
                          <td><?=$key + 1?></td>
                          <td><?=$location["title"]?></td>
                          <td>
                            <h5>
                              <a href="/admin/location/update/<?= $location["id"] ?>">
                                <i class="fa-solid fa-gear shadow" style="color:green; cursor:pointer"></i>
                              </a>
                              <form action="/admin/location/delete" style="display:inline;"  method="POST">
                                <input type="hidden" name="id" value="<?=$location["id"]?>">
                                <button type="submit" class="btn btn-danger btn-sm" sty >
                                  <i class="fa-solid fa-trash-can shadow" style="cursor:pointer;"></i>
                                </button>
                              </form>
                              </form>
                            </h5>
                          </td>
                        </tr>
                        <?php endforeach?>
                      <tfoot>
                        <tr>
                          <th class="th-sm">#</th>
                          <th class="th-md">Location</th>
                          <th class="th-sm">Action</th>
                        </tr>
                      </tfoot>
                    </table>
                </div>
          </di>
        </div>
<?php include INC_BACKEND . "/footer.php"?>

