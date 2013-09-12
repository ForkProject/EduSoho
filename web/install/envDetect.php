<?php
require_once('./header.php');
?>

<body>
<?php
$allowNext = 'yes';
?>
<div class="container" style="width:940px">
    
  <div class="es-row-wrap">

      <div class="row">

        <div class="col-lg-12">
          
            <div class="es-box">

            <div class="setup-wizard">
              <span class="pull-left text-primary" style="font-weight:900;font-size:250%">Edusoho</span>
              &nbsp;&nbsp;&nbsp;&nbsp;
              <span class="text-success" style="font-weight:900;font-size:250%">安装向导</span>
            </div>
            <hr>
          
          <ul class="nav nav-pills nav-justified">
            <li class="active disabled"><a >1 环境检测</a></li>
            <li class="disabled"><a>2 创建数据库</a></li>
            <li class="disabled"><a>3 初始化系统</a></li>
            <li class="disabled"><a>4 完成安装</a></li>
          </ul>
          <hr>

          <div class="server">

            <table  class="table table-striped table-hover table-bordered">
              <thead>
                <tr>
                  <th width="25%">环境检测</th>
                  <th width="25%">推荐配置</th>
                  <th width="25%">当前状态</th>
                  <th width="25%">最低要求</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>操作系统</td>
                  <td>类UNIX</td>
                  <td>
                    <strong>
                      <?php 
                        if(PHP_OS == 'Linux' || PHP_OS == 'Darwin'){
                      ?>
                      <p class="text-success">√ Linux / Mac OS X </p>
                      <?php
                        } else {
                      ?>
                      <p class="text-danger">X 检测失败</p>
                      <?php
                          $allowNext = 'no';
                        }
                      ?>
                    </strong>
                  </td>
                  <td>Linux </td>
                </tr>
                <tr>
                  <td>PHP版本</td>
                  <td>5.3.17</td>
                  <td>
                    <strong>
                      <?php
                      if(version_compare(PHP_VERSION, '5.3.0') >= 0){
                      ?>
                       <p class="text-success">√ <?php  echo PHP_VERSION; ?> </p>
                     <?php 
                      } else {
                        ?>
                        <p class="text-danger">X <?php  echo PHP_VERSION; ?> </p>
                      <?php 
                        $allowNext = 'no';
                      }
                      ?>
                    </strong>
                  </td>
                  <td>5.3.0</td>
                </tr>
                <tr>
                  <td>PDO_MySQL</td>
                  <td>必须</td>
                  <td>
                    <strong>
                   <?php
                   if (extension_loaded('pdo_mysql')){
                    ?>
                    <p class="text-success">√已安装</p>
                    <?php } else { ?>
                    <p class="text-danger">X尚未安装MySQL_PDO</p>
                    <?php $allowNext = 'no'; } ?>
                    </strong>
                  </td>
                  <td>必须</td>
                </tr>
                <tr>
                  <td>附件上传</td>
                  <td>20MB</td>
                  <td>
                    <strong>
                   <?php
                   if(ini_get('upload_max_filesize') >= 2){
                    ?>
                     <p class="text-success">√<?php echo ini_get('upload_max_filesize'); ?></p>
                   <?php } else { ?>
                     <p class="text-danger">X<?php echo ini_get('upload_max_filesize'); ?></p>
                    <?php
                    $allowNext = 'no'; }
                    ?>
                  </strong>
                  </td>
                  <td>2MB</td>
                </tr>
                <tr>
                  <td>磁盘空间</td>
                  <td>>1G</td>
                  <td>
                    <strong>
                      <?php
                      if(intval(disk_free_space('/')/(1024*1024)) > 50){
                        ?>
                     <p class="text-success">√<?php echo intval(disk_free_space('/')/(1024*1024)).'MB'; ?></p>
                      <?php } else { ?>
                     <p class="text-danger">X<?php echo intval(disk_free_space('/')/(1024*1024)).'MB'; ?></p>
                        <?php $allowNext = 'no';  } ?>
                    </strong>
                  </td>
                  <td>50M</td>
                </tr>
              </tbody>
            </table>

            <table class="table table-hover table-striped table-bordered">
              <thead>
                <tr>
                  <th width="50%">目录、文件权限检查</th>
                  <th width="25%">当前状态</th>
                  <th width="25%">所需状态</th>
                </tr>
              </thead>
              <tbody>
                               
                <tr>
                  <td>app/config/parameters.yml</td>
                  <td>
                    <strong>
                    <?php
                    $file = "../../app/config/parameters.yml";
                    if (is_executable($file) && is_writable($file) && is_readable($file)) {
                        echo "<p class='text-success'>√可写</p>";
                    } else {
                        echo "<p class='text-danger'>X不可写</p>";
                        $allowNext = 'no';
                    }
                    ?>
                    </strong>
                    </td>
                  <td>可写</td>
                </tr>

                <tr>
                  <td>app/data/udisk</td>
                  <td>
                    <strong>
                     <?php
                    $file = "../../app/data/udisk";
                    if (is_executable($file) && is_writable($file) && is_readable($file)) {
                      echo "<p class='text-success'>√可写</p>";
                    } else {
                      echo "<p class='text-danger'>X不可写</p>";
                        $allowNext = 'no';
                    }
                    ?>
                    </strong>
                    </td>
                  <td>可写</td>
                </tr>
                <tr>
                  <td>app/data/private_files</td>
                  <td>
                   <strong>
                   <?php
                    $file = "../../app/data/private_files";
                    if (is_executable($file) && is_writable($file) && is_readable($file)) {
                      echo "<p class='text-success'>√可写</p>";
                    } else {
                      echo "<p class='text-danger'>X不可写</p>";
                        $allowNext = 'no';
                    }
                    ?>
                    </strong>
                  </td>
                  <td>可写</td>
                </tr>

                <tr>
                  <td>web/files</td>
                  <td>
                    <strong>
                   <?php
                    $file = "../../web/files";
                    if (is_executable($file) && is_writable($file) && is_readable($file)) {
                      echo "<p class='text-success'>√可写</p>";
                    } else {
                      echo "<p class='text-danger'>X不可写</p>";
                        $allowNext = 'no';
                    }
                    ?>
                    </strong>
                  </td>
                  <td>可写</td>
                </tr>

                <tr>
                  <td>web/install</td>
                  <td>
                    <strong>
                    <?php
                    $file = "../../web/install";
                    if (is_executable($file) && is_writable($file) && is_readable($file)) {
                      echo "<p class='text-success'>√可写</p>";
                    } else {
                      echo "<p class='text-danger'>X不可写</p>";
                        $allowNext = 'no';
                    }
                    ?>
                    </strong>
                  </td>
                  <td>可写</td>
                </tr>

                <tr>
                  <td>app/cache</td>
                  <td>
                    <strong>
                    <?php
                    $file = "../../app/cache";
                    if (is_executable($file) && is_writable($file) && is_readable($file)) {
                       echo "<p class='text-success'>√可写</p>";
                    } else {
                      echo "<p class='text-danger'>X不可写</p>";
                        $allowNext = 'no';
                    }
                    ?>
                    </strong>
                  </td>
                  <td>可写</td>
                </tr>

                <tr>
                  <td>app/logs</td>
                  <td>
                     <strong>
                    <?php
                    $file = "../../app/logs";
                    if (is_executable($file) && is_writable($file) && is_readable($file)) {
                      echo "<p class='text-success'>√可写</p>";
                    } else {
                      echo "<p class='text-danger'>X不可写</p>";
                        $allowNext = 'no';
                    }
                    ?>
                    </strong>
                  </td>
                  <td>可写</td>
                </tr>
              </tbody>
            </table>

          </div>

          <?php
          if(file_exists("./install.lock")){
            $allowNext = 'no';
          ?>
          <h4 align="center" class="text-warning"> 你已经安装过Edusoho1.0版本，如想重新安装，请在删除 "web/install/install.lock" 文件之后重新检测！<h4>
          <?php } ?>

          <div class="next" style="text-align:center">
              <?php if($allowNext == 'yes'){ ?>
              <a href="./dataBasepage.php" class="btn btn-primary btn-lg" role="button" >下一步</a>
              <?php } elseif ($allowNext == 'no'){ ?>
              <a href="./envDetect.php" class="btn btn-primary btn-lg" role="button" >重新检测</a>
                <h3 class="text-danger"> 安装环境检测没有通过，请正确设置环境之后，重新检测！</h3>
              <?php } ?>
          </div>

          </div>

        </div>

      </div>

  </div>

</div>

</body>

</html>