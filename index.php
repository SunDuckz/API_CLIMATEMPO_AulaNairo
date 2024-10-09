
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cidade</title>
<link rel="stylesheet" href="style.css">
</head>

<?php
    $url = "http://apiadvisor.climatempo.com.br/api/v1/forecast/locale/5092/days/15?token=4d1dd873443936772deffe0c391bcb2f";
    $curl = curl_init();

    curl_setopt_array($curl, [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true
    ]);

    $response = curl_exec($curl);
    curl_close($curl);
    $cidade = json_decode($response, true);
    $InfoHoje = $cidade["data"][0];
    $chuvaPrecipitacao = floatval($InfoHoje["rain"]["precipitation"]);
    $chuvaPorcentagem = $InfoHoje["rain"]["probability"];
    $ventoSentido = $InfoHoje["wind"]["direction"];
    $ventoVelocidade = $InfoHoje["wind"]["velocity_avg"];
    $umidadeMin = $InfoHoje["humidity"]["min"];
    $umidadeMax = $InfoHoje["humidity"]["max"];
    $sunrise = $InfoHoje["sun"]["sunrise"];
    $sunset = $InfoHoje["sun"]["sunset"];
    $dawnImg = $InfoHoje["text_icon"]["icon"]["dawn"];
    $morningImg = $InfoHoje["text_icon"]["icon"]["morning"];
    $afternoonImg = $InfoHoje["text_icon"]["icon"]["afternoon"];
    $nightImg = $InfoHoje["text_icon"]["icon"]["night"];
    $windAngle = $InfoHoje["wind"]["direction_degrees"];




?>
<style>
.image-rotate{
    transform: rotate(<?=$windAngle?>deg);
}
.vento{
    display: flex;
    border-left: 6px solid rgb(74, 74, 74);
    margin: 20px;
    padding-left: 10px;
    border-radius: 5px;
    background-color: rgb(212, 211, 211);
}
</style>
<body>
    <header>
        <h1>Previsão para Hoje <?=$InfoHoje["date_br"] ?> de <?= $cidade["name"]?> - <?= $cidade["state"]?></h1>
    </header>

    <body>
        <div class="tabela-principal">
            <h2><?= $InfoHoje["text_icon"]["text"]["pt"]?></h2>
            <div class="tabela-imagens">
                <div><img src="/images/<?=$dawnImg?>.png" alt="dawn" ></div>
                <div>Madrugada</div>
                <div><img src="/images/<?=$morningImg?>.png" alt="morn"></div>
                <div>Manhã</div>
                <div><img src="/images/<?=$afternoonImg?>.png" alt="noon"></div>
                <div>Tarde</div>
                <div><img src="/images/<?=$nightImg?>.png" alt="night"></div>
                <div>Noite</div>
            </div>
            <div style="padding-bottom: 15px;" class="temperatura">
                <h3>temperatura:</h3>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="20" fill="red" class="bi bi-arrow-up" viewBox="0 -3 16 16">
                        <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5"/>
                    </svg>
                    <span><?= $InfoHoje["temperature"]["max"] ?> Cº</span>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="20" fill="#4dd1fd" class="bi bi-arrow-down" viewBox="0 -3 16 16">
                        <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1"/>
                    </svg>
                    <span><?= $InfoHoje["temperature"]["min"] ?> Cº</span>
                </div>
            </div>
            <div class="chuva">
                <h3>Chuva:</h3>
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="blue" class="bi bi-droplet-fill" viewBox="0 0 16 16">
                    <path d="M8 16a6 6 0 0 0 6-6c0-1.655-1.122-2.904-2.432-4.362C10.254 4.176 8.75 2.503 8 0c0 0-6 5.686-6 10a6 6 0 0 0 6 6M6.646 4.646l.708.708c-.29.29-1.128 1.311-1.907 2.87l-.894-.448c.82-1.641 1.717-2.753 2.093-3.13"/>
                </svg>
                <div style="padding-bottom: 15px;" ><?=round($chuvaPrecipitacao,1)?>mm - <?=$chuvaPorcentagem?>% </div>
            </div>
            <div class="vento">
                <img src="/images/cima.png" alt="wind-direction" class="image-rotate">
                <h3>Vento:</h3>
                <div style="padding-top: 15px;"><?= $ventoSentido ?> - <?= $ventoVelocidade ?> KM/H</div>
            </div>
            <div class="umidade">
                <h3>Umidade:</h3>
                <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="20" fill="red" class="bi bi-arrow-up" viewBox="0 -3 16 16">
                        <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5"/>
                    </svg>
                    <span><?=$umidadeMax?>%</span>
                </div>
                <div style="padding-bottom: 15px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="20" fill="#4dd1fd" class="bi bi-arrow-down" viewBox="0 -3 16 16">
                        <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1"/>
                    </svg>
                    <span><?= $umidadeMin?>% </span>
                </div>
            </div>
            <div class="sol">
                <h3>Sol:</h3>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sunrise" viewBox="0 0 16 16">
                    <path d="M7.646 1.146a.5.5 0 0 1 .708 0l1.5 1.5a.5.5 0 0 1-.708.708L8.5 2.707V4.5a.5.5 0 0 1-1 0V2.707l-.646.647a.5.5 0 1 1-.708-.708zM2.343 4.343a.5.5 0 0 1 .707 0l1.414 1.414a.5.5 0 0 1-.707.707L2.343 5.05a.5.5 0 0 1 0-.707m11.314 0a.5.5 0 0 1 0 .707l-1.414 1.414a.5.5 0 1 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0M8 7a3 3 0 0 1 2.599 4.5H5.4A3 3 0 0 1 8 7m3.71 4.5a4 4 0 1 0-7.418 0H.499a.5.5 0 0 0 0 1h15a.5.5 0 0 0 0-1h-3.79zM0 10a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2A.5.5 0 0 1 0 10m13 0a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5"/>
                </svg>  
                <div>Nascer do Sol: <?= $sunrise ?></div>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sunset" viewBox="0 0 16 16">
                    <path d="M7.646 4.854a.5.5 0 0 0 .708 0l1.5-1.5a.5.5 0 0 0-.708-.708l-.646.647V1.5a.5.5 0 0 0-1 0v1.793l-.646-.647a.5.5 0 1 0-.708.708zm-5.303-.51a.5.5 0 0 1 .707 0l1.414 1.413a.5.5 0 0 1-.707.707L2.343 5.05a.5.5 0 0 1 0-.707zm11.314 0a.5.5 0 0 1 0 .706l-1.414 1.414a.5.5 0 1 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zM8 7a3 3 0 0 1 2.599 4.5H5.4A3 3 0 0 1 8 7m3.71 4.5a4 4 0 1 0-7.418 0H.499a.5.5 0 0 0 0 1h15a.5.5 0 0 0 0-1h-3.79zM0 10a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2A.5.5 0 0 1 0 10m13 0a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5"/>
                </svg>
                <div style="padding-bottom: 15px;">Pôr do sol: <?= $sunset ?></div>
            </div>
        </div>
    </body>
</html> 