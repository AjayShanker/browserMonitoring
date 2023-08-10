<?php
    require_once 'vendor/autoload.php';

    use DeviceDetector\ClientHints;
    use DeviceDetector\DeviceDetector;
    use DeviceDetector\Parser\Device\AbstractDeviceParser;
    use DeviceDetector\Parser\OperatingSystem;
    use DeviceDetector\Parser\Client\Browser;

    // OPTIONAL: Set version truncation to none, so full versions will be returned
    // By default only minor versions will be returned (e.g. X.Y)
    // for other options see VERSION_TRUNCATION_* constants in DeviceParserAbstract class
    AbstractDeviceParser::setVersionTruncation(AbstractDeviceParser::VERSION_TRUNCATION_NONE);

    $userAgent = $_SERVER['HTTP_USER_AGENT']; // change this to the useragent you want to parse
    $clientHints = ClientHints::factory($_SERVER); // client hints are optional

    $dd = new DeviceDetector($userAgent, $clientHints);

    $osFamily = OperatingSystem::getOsFamily($dd->getOs('name'));
    $browserFamily = Browser::getBrowserFamily($dd->getClient('name'));




	$continent = $continentCode = $country = $countryCode = $region = $regionName = $city = $zip = $lat = $lon = $timezone = $isp = $org = $as = $query = '';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://ip-api.com/json");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($ch);
    $result = json_decode($result);
    if($result->status == 'success')
    {        
        $country = !empty($result->country) ? $result->country : '';
        $countryCode = !empty($result->countryCode) ? $result->countryCode : '';
        $region = !empty($result->region) ? $result->region : '';
        $regionName = !empty($result->regionName) ? $result->regionName : '';
        $city = !empty($result->city) ? $result->city : '';
        $zip = !empty($result->zip) ? $result->zip : '';
        $lat = !empty($result->lat) ? $result->lat : '';
        $lon = !empty($result->lon) ? $result->lon : '';
        $timezone = !empty($result->timezone) ? $result->timezone : '';
        $isp = !empty($result->isp) ? $result->isp : '';
        $org = !empty($result->org) ? $result->org : '';
        $as = !empty($result->as) ? $result->as : '';
        $query = !empty($result->query) ? $result->query : '';
    }
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
    <title>Browser monitoring</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" ><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    </head>
        <body>


        <div class="container">
           
            <?php
            $dd->parse();

            if ($dd->isBot()) {
              // handle bots,spiders,crawlers,...
              $botInfo = $dd->getBot();
            } else {
              $clientInfo = $dd->getClient(); // holds information about browser, feed reader, media player, ...
              $osInfo = $dd->getOs();
              $device = $dd->getDeviceName();
              $brand = $dd->getBrandName();
              $model = $dd->getModel();
            }

            // echo '<PRE>';
            // print_r($dd);
           
            ?>
            <!-- <table class="table">
            <thead>
                <tr>
                <th scope="col">Smart Phone</th>
                <th scope="col">Feature Phone</th>
                <th scope="col">Tablet</th>
                <th scope="col">Phablet</th>
                <th scope="col">Console</th>
                <th scope="col">Portable Media Player</th>
                <th scope="col">Car Browser</th>
                <th scope="col">TV</th>
                <th scope="col">Smart Display</th>
                <th scope="col">Smart Speaker</th>
                <th scope="col">Camera</th>
                <th scope="col">Wearable</th>
                <th scope="col">Peripheral</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row"><?php echo $dd->isSmartphone();?></th>
                    <td><?php echo $dd->isFeaturePhone();?></td>
                    <td><?php echo $dd->isTablet();?></td>
                    <td><?php echo $dd->isPhablet();?></td>
                    <td><?php echo $dd->isConsole();?></td>
                    <td><?php echo $dd->isPortableMediaPlayer();?></td>
                    <td><?php echo $dd->isCarBrowser();?></td>
                    <td><?php echo $dd->isTV();?></td>
                    <td><?php echo $dd->isSmartDisplay();?></td>
                    <td><?php echo $dd->isSmartSpeaker();?></td>
                    <td><?php echo $dd->isCamera();?></td>
                    <td><?php echo $dd->isWearable();?></td>
                    <td><?php echo $dd->isPeripheral();?></td>
                </tr>
                </tbody>
            </table>


            <table class="table table-dark">
            <thead>
                <tr>
                <th scope="col">Browser</th>
                <th scope="col">Feed Reader</th>
                <th scope="col">Mobile App</th>
                <th scope="col">PIM</th>
                <th scope="col">Library</th>
                <th scope="col">Media Player</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row"><?php echo $dd->isBrowser();?></th>
                    <td><?php echo $dd->isFeedReader();?></td>
                    <td><?php echo $dd->isMobileApp();?></td>
                    <td><?php echo $dd->isPIM();?></td>
                    <td><?php echo $dd->isLibrary();?></td>
                    <td><?php echo $dd->isMediaPlayer();?></td>
                </tr>
                </tbody>
            </table> -->

            <div class="row">
                <div class="col-lg-3 p-0 card">
                    <div class="card-header">
                        Operating System
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><?php echo '<strong>Name: </strong>'. $dd->getOs('name'); ?></li>
                            <li class="list-group-item"><?php echo '<strong>Short Name: </strong>'. $dd->getOs('short_name'); ?></li>
                            <li class="list-group-item"><?php echo '<strong>Version: </strong>'. $dd->getOs('version'); ?></li>
                            <li class="list-group-item"><?php echo '<strong>Platform: </strong>'. $dd->getOs('platform'); ?></li>
                            <li class="list-group-item"><?php echo '<strong>Family: </strong>'. $dd->getOs('family'); ?></li>
                        </ul>
                    </div>
                </div>    

            <?php 
                $browserFamilyType = Browser::getBrowserFamily($dd->getClient('type'));
                $browserFamilyName = Browser::getBrowserFamily($dd->getClient('name'));
                $browserFamilyShortName = Browser::getBrowserFamily($dd->getClient('short_name'));
                $browserFamilyVersion = Browser::getBrowserFamily($dd->getClient('version'));
                $browserFamilyEngine = Browser::getBrowserFamily($dd->getClient('engine'));
                $browserFamilyEngineVersion = Browser::getBrowserFamily($dd->getClient('engine_version'));
                $browserFamily = Browser::getBrowserFamily($dd->getClient('family'));
            ?>

                <div class="col-lg-3 p-0 card">
                    <div class="card-header">
                     Browser Family
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><?php echo '<strong>Type: </strong>'; ?> <?php echo !empty($clientInfo) ? ($clientInfo['type']) : ''; ?></li>
                            <li class="list-group-item"><?php echo '<strong>Name: </strong>'; ?> <?php echo !empty($clientInfo) ? ($clientInfo['name']) : ''; ?></li>
                            <li class="list-group-item"><?php echo '<strong>Short Name: </strong>'; ?> <?php echo !empty($clientInfo) ? ($clientInfo['short_name']) : ''; ?></li>
                            <li class="list-group-item"><?php echo '<strong>Version: </strong>'; ?> <?php echo !empty($clientInfo) ? ($clientInfo['version']) : ''; ?></li>
                            <li class="list-group-item"><?php echo '<strong>Engine: </strong>'; ?> <?php echo !empty($clientInfo) ? ($clientInfo['engine']) : ''; ?></li>
                            <li class="list-group-item"><?php echo '<strong>Engine Version: </strong>'; ?> <?php echo !empty($clientInfo) ? ($clientInfo['engine_version']) : ''; ?></li>
                            <li class="list-group-item"><?php echo '<strong>Family: </strong>'; ?> <?php echo !empty($clientInfo) ? ($clientInfo['family']) : ''; ?></li>
                        </ul>
                    </div>
                </div> 



                <div class="col-lg-3 p-0 card">
                    <div class="card-header">
                        Other Details
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><?php echo '<strong>Device Name: </strong>'; ?> <?php echo !empty($device) ? ($device) : ''; ?></li>
                            <li class="list-group-item"><?php echo '<strong>Brand: </strong>'; ?> <?php echo !empty($brand) ? ($brand) : ''; ?></li>
                            <li class="list-group-item"><?php echo '<strong>Model: </strong>'; ?> <?php echo !empty($model) ? ($model) : ''; ?></li>
                        </ul>
                    </div>
                </div> 
				
				<div class="col-lg-3 p-0 card">
                    <div class="card-header">
                        User's Details
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><?php echo '<strong>Country: </strong>'; ?> <?php echo !empty($country) ? $country : ''; ?></li>
                            <li class="list-group-item"><?php echo '<strong>Country Code: </strong>'; ?> <?php echo !empty($countryCode) ? $countryCode : ''; ?></li>
                            <li class="list-group-item"><?php echo '<strong>Region: </strong>'; ?> <?php echo !empty($region) ? $region : ''; ?></li>
                            <li class="list-group-item"><?php echo '<strong>Region Name: </strong>'; ?> <?php echo !empty($regionName) ? $regionName : ''; ?></li>
                            <li class="list-group-item"><?php echo '<strong>City: </strong>'; ?> <?php echo !empty($city) ? $city : ''; ?></li>
                            <li class="list-group-item"><?php echo '<strong>Zip Code: </strong>'; ?> <?php echo !empty($zip) ? $zip : ''; ?></li>
                            <li class="list-group-item"><?php echo '<strong>Latitude: </strong>'; ?> <?php echo !empty($lat) ? $lat : ''; ?></li>
                            <li class="list-group-item"><?php echo '<strong>Longitude: </strong>'; ?> <?php echo !empty($lon) ? $lon : ''; ?></li>
                            <li class="list-group-item"><?php echo '<strong>Timezone: </strong>'; ?> <?php echo !empty($timezone) ? $timezone : ''; ?></li>
                            <!-- <li class="list-group-item"><?php echo '<strong>isp: </strong>'; ?> <?php echo !empty($isp) ? $isp : ''; ?></li>
                            <li class="list-group-item"><?php echo '<strong>org: </strong>'; ?> <?php echo !empty($org) ? $org : ''; ?></li>
                            <li class="list-group-item"><?php echo '<strong>as: </strong>'; ?> <?php echo !empty($as) ? $as : ''; ?></li> -->
                            <li class="list-group-item"><?php echo '<strong>IP Address: </strong>'; ?> <?php echo !empty($query) ? $query : ''; ?></li>
                        </ul>
                    </div>
                </div>
				
				
            </div>



        </div>

        </body>
    </html>