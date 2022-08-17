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
    <?php MessageReporting::flash(MessagesName::Building)?>
                    <table id="dtBasicExample" class="table table-striped table-bordered table-lg table-hover table-condensed" cellspacing="0" width="100%">
                      <thead class="black white-text" >
                        <tr>
                            <th class="th-sm">#</th>
                            <th class="th-lg">title</th>
                            <th class="th-sm">client</th>
                            <th class="th-sm">scope</th>
                            <th class="th-sm">area</th>
                            <th class="th-sm">budget</th>
                            <th class="th-sm">location</th>
                            <th class="th-sm">category</th>
                            <th class="th-sm">latest_project</th>
                            <th class="th-sm">action</th>
                            
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($data["building"] as $key => $building): ?>
                        <tr>
                          <td><img src="<?= UP2 . "/" . $building["main_image"] ?>" alt="" width="200px" height="200px"></td>
                          <td><?=$building["title"]?></td>
                          <td><?=$building["client"]?></td>
                          <td><?=$building["scope"]?></td>
                          <td><?=$building["area"]?></td>
                          <td><?=$building["budget"]?></td>
                          <td><?=$building["location"]?></td>
                          <td><?=$building["category"]?></td>
                          <td><?=$building["latest_project"]?></td>
                          <td>
                            <h5>
                              <a href="/admin/building/update/<?= $building["id"] ?>">
                                <i class="fa-solid fa-gear shadow" style="color:green; cursor:pointer"></i>
                              </a>
                              <form action="/admin/building/delete" style="display:inline;"  method="POST">
                                <input type="hidden" name="id" value="<?=$building["id"]?>">
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
                            <th class="th-lg">title</th>
                            <th class="th-sm">Client</th>
                            <th class="th-sm">scope</th>
                            <th class="th-sm">area</th>
                            <th class="th-sm">buget</th>
                            <th class="th-sm">location</th>
                            <th class="th-sm">category</th>
                            <th class="th-sm">latest_project</th>
                            <th class="th-sm">action</th>
                        </tr>
                      </tfoot>
                    </table>
                </div>
          </di>
        </div>













<?php include INC_BACKEND . "/footer.php";?>
