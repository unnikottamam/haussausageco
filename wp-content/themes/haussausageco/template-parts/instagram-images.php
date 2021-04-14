<?php
/**
 * Template part for displaying instagram images
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package haussausageco
 */

$token =
  'IGQVJVQkxMNHVReWp6LU9wWWZAZAM1NNLTFLUER3WWJiZAVZAzaFZARaE8tc25DWS1zbE9zS0F4SDhiOTJZAVEtIMTVOa25KZAHdrckc2Wl81REhydGRhdHh2bnd2NjJTMHdZAT3BBU21jTE4xeWpXUDlCa3hzdAZDZD';
$remote_wp = wp_remote_get(
  "https://graph.instagram.com/me/media?fields=id,media_type,media_url,permalink,caption&access_token=" .
    $token
);

$datalist = json_decode($remote_wp['body']);

if ($remote_wp['response']['code'] == 200) { ?>
<section class="instaposts">
    <div class="container-fluid">
        <div class="row text-center">
            <div class="col-12">
                <h4>INSTAGRAM</h4>
                <h2>@haussausageco</h2>
            </div>
            <?php
            $count = 0;
            $response = $datalist->data;
            // shuffle($response);
            foreach ($response as $res) {
              if ($res->media_type == "IMAGE") {
                $count++; ?>
            <div class="col">
                <a target="_blank" href="<?php echo $res->permalink; ?>">
                    <img src="<?php echo $res->media_url; ?>" alt="<?php echo $res->caption; ?>">
                </a>
            </div>
            <?php
              } ?>
            <?php if ($count == 4) {
              break;
            }
            }
            ?>
        </div>
    </div>
</section>
<?php }