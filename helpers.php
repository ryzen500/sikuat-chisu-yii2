<?php

use app\models\TbHasilLab;
use app\models\TbPermohonanLab;
use app\models\TbTerduga;
use backend\Services\MediatorService;
use GuzzleHttp\Exception\GuzzleException;
use Mediator\SatuSehat\Lib\Client\ApiException;
use Mediator\SatuSehat\Lib\Client\Configuration;
use Mediator\SatuSehat\Lib\Client\ConfigurationConstant;
use Mediator\SatuSehat\Lib\Client\Model\AddressPatient;
use Mediator\SatuSehat\Lib\Client\Model\Patient;
use Mediator\SatuSehat\Lib\Client\Model\SubmitResponse;
use Mediator\SatuSehat\Lib\Client\Model\TbSuspect;
use Mediator\SatuSehat\Lib\Client\Profiles\TB\Forms\Diagnosis;
use Mediator\SatuSehat\Lib\Client\Profiles\TB\Forms\HasilLab;
use Mediator\SatuSehat\Lib\Client\Profiles\TB\Forms\PermohonanLab;
use Mediator\SatuSehat\Lib\Client\Profiles\TB\Forms\Terduga;

/**
 * @param string $date
 * @return string
 * @throws Exception
 */
function parseDateTimeWithTimezone(string $date): string
{
    return (new DateTime(
        date('Y-m-d H:i:s',
            strtotime('-4 sec',
                strtotime($date . ' ' . date('H:i:s'))
            ))
    ))->setTimezone(new DateTimeZone('UTC'))->format('c');
}

/**
 * @param string $date
 * @return string
 * @throws Exception
 */
function parseDateTime(string $date): string
{
    return date('Y-m-d h:i:s',strtotime($date));
}


/**
 * @return void
 */
function initConfiguration()
{
    Configuration::setConfigurationConstant(
        'development',
        new ConfigurationConstant(
            'https://api-satusehat-stg.dto.kemkes.go.id/oauth2/v1/accesstoken',
            'https://api-satusehat-stg.dto.kemkes.go.id/oauth2/v1/refreshtoken',
            'https://mediator-satusehat.kemkes.go.id/api-dev/satusehat/rme/v1.0',
            'https://mediator-satusehat.kemkes.go.id/api-dev/satusehat/rme/v1.0',
            // 'd9ESOUMI9Do48xlFI20bhZFS2MLTNzKHaDHDAK5TiElt8h2s',// $clientId,
            // 'xMrGZJoq4ubpjuesabPFSuACAKnQbG8RdGl72s8yldKzCRqwbp111wmwKpLehA6e',// $clientSecret,
            // null// 'SUOnOVYse8WHvIt9b3i9BhaxA60H',
            null,
            null,
            'Ske9QQFjqUunZRHYkGtYeXViTHL8',
            '+07:00'
        )
    );
}

/**
 * @param array $input
 * @param TbTerduga $tbTerduga
 * @return true
 * @throws GuzzleException
 * @throws ApiException
 */
function kirimTerdugaTB(array $input, TbTerduga $tbTerduga): bool
{
    initConfiguration();
    $patient = new Patient(); // TODO: cannot be hardcoded
    $patient->setNik("9104025209000006"); // TODO: cannot be hardcoded s
    $patient->setName("PASIEN 6"); // TODO: cannot be hardcoded
    $patient->setBirthDate("2000-09-12"); // TODO: cannot be hardcoded
    $patient->setAddress([new AddressPatient(
        [
            "use" => "temp", // temp = alamat domisili, home = alamat ktp
            // "country" => "id",
            "province" => "35", // kode depdagri 2 digit untuk provinsi
            "city" => "3578", // kode depdagri 4 digit untuk kab/kota
            "district" => "357801", // kode depdagri 6 digit untuk kecamatan
            "village" => "3578011002", // kode depdagri 10 digit untuk kelurahan/desa
            "rt" => "",
            "rw" => "",
            "postal_code" => "-",
            "line" => ["alamat jalan dan informasi lainnya"]
        ]
    )]);

    $tbSuspect = new TBSuspect();
    $tbSuspect
        // ->setId('2405101601149056')// TODO: conditional
//            ->setPersonId('2405101601149056') // TODO: conditional
        ->setFasyankesId('1000119617') // TODO: cannot be hardcoded, proses di ambil dari puskesmas, boleh kembali di database
        ->setJenisFasyankesId('1') // // TODO: conditional, proses di ambil dari puskesmas 1 = puskesmas, 2 = rumah sakit, 3 = klinik
        ->setTerdugaTbId('1') // todo: diambil dari input /database
        ->setTerdugaRoId(null) // todo: hanya diisi ketika id = 2, diambil dari input / database
        ->setTipePasienId('1'); //

    /** Note: if you want to reduce time while execute the process, you can move script bellow into queue */
    $kunjungan = '2024-05-24 10:27:26.405593+07';
    $service = new MediatorService(
        Terduga::class,
        '10000004',
        'ef011065-38c9-46f8-9c35-d1fe68966a3e',
        'N10000001',
        $kunjungan,
        $tbSuspect,
        $patient
    );
    // dump($service);die;

    $response = $service->sendTerdugaTb($input);

    // dump($response);die;
    if ($response instanceof SubmitResponse) {
        $service->storeSatuSehat($response, $tbTerduga, [
            'kunjungan' => $kunjungan,
            'pasien' => $patient->getNik(),
            'faskes' => '',
        ]);
    }

    return true;
}

/**
 * @param array $input
 * @param TbPermohonanLab $permohonanLabModel
 * @return bool
 */
function kirimPermohonanLab(array $input, TbPermohonanLab $permohonanLabModel): bool
{
    initConfiguration();
    $patient = new Patient(); // TODO: cannot be hardcoded
    $patient->setNik("9104025209000006"); // TODO: cannot be hardcoded s
    $patient->setName("PASIEN 6"); // TODO: cannot be hardcoded
    $patient->setBirthDate("2000-09-12"); // TODO: cannot be hardcoded

    $tbSuspect = new TBSuspect();
    $tbSuspect
        ->setId('2405101601149056')// TODO: conditional
//            ->setPersonId('2405101601149056') // TODO: conditional
        ->setFasyankesId('1000119617') // TODO: cannot be hardcoded, proses di ambil dari puskesmas, boleh kembali di database
        ->setJenisFasyankesId('1') // // TODO: conditional, proses di ambil dari puskesmas 1 = puskesmas, 2 = rumah sakit, 3 = klinik
        ->setTerdugaTbId('1') // todo: diambil dari input /database
        ->setTerdugaRoId(null) // todo: hanya diisi ketika id = 2, diambil dari input / database
        ->setTipePasienId('1'); //

    /** Note: if you want to reduce time while execute the process, you can move script bellow into queue */
    $kunjungan = '2024-05-24 09:27:26.405593+07';
    $service = new MediatorService(
        PermohonanLab::class,
        '10000004',
        'ef011065-38c9-46f8-9c35-d1fe68966a3e',
        'N10000001',
        $kunjungan,
        $tbSuspect,
        $patient
    );
    $response = $service->sendPermohonanLab($input);


    if ($response instanceof SubmitResponse) {
        $service->storeSatuSehat($response, $permohonanLabModel, [
            'kunjungan' => $kunjungan,
            'pasien' => $patient->getNik(),
            'faskes' => '',
        ]);
    }

    return true;
}

/**
 * @param array $input
 * @param TbHasilLab $hasilLabModel
 * @return bool
 * @throws GuzzleException
 * @throws ApiException
 */
function kirimHasilLab(array $input, TbHasilLab $hasilLabModel): bool
{
    initConfiguration();
    $patient = new Patient(); // TODO: cannot be hardcoded
    $patient->setNik("9104025209000006"); // TODO: cannot be hardcoded s
    $patient->setName("PASIEN 6"); // TODO: cannot be hardcoded
    $patient->setBirthDate("2000-09-12"); // TODO: cannot be hardcoded

    $tbSuspect = new TBSuspect();
    $tbSuspect
        ->setId('2405101601149056')// TODO: conditional
//            ->setPersonId('2405101601149056') // TODO: conditional
        ->setFasyankesId('1000119617') // TODO: cannot be hardcoded, proses di ambil dari puskesmas, boleh kembali di database
        ->setJenisFasyankesId('1') // // TODO: conditional, proses di ambil dari puskesmas 1 = puskesmas, 2 = rumah sakit, 3 = klinik
        ->setTerdugaTbId('1') // todo: diambil dari input /database
        ->setTerdugaRoId(null) // todo: hanya diisi ketika id = 2, diambil dari input / database
        ->setTipePasienId('1'); //

    /** Note: if you want to reduce time while execute the process, you can move script bellow into queue */
    $kunjungan = '2024-05-24 09:27:26.405593+07';
    $service = new MediatorService(
        HasilLab::class,
        '10000004',
        'ef011065-38c9-46f8-9c35-d1fe68966a3e',
        'N10000001',
        $kunjungan,
        $tbSuspect,
        $patient
    );

    $response = $service->sendHasilLab($input);
    if ($response instanceof SubmitResponse) {
        $service->storeSatuSehat($response, $hasilLabModel, [
            'kunjungan' => $kunjungan,
            'pasien' => $patient->getNik(),
            'faskes' => '',
        ]);
    }

    return true;
}

/**
 * @param array $input
 * @param TbHasilLab $hasilLabModel
 * @return void
 * @throws GuzzleException
 * @throws ApiException
 */
function kirimHasilDiagnosa(array $input, TbHasilLab $hasilLabModel)
{

    $patient = new Patient(); // TODO: cannot be hardcoded
    $patient->setNik("9104025209000006"); // TODO: cannot be hardcoded s
    $patient->setName("PASIEN 6"); // TODO: cannot be hardcoded
    $patient->setBirthDate("2000-09-12"); // TODO: cannot be hardcoded

    $tbSuspect = new TBSuspect();
    $tbSuspect
        ->setId('2405101601149056')// TODO: conditional
//            ->setPersonId('2405101601149056') // TODO: conditional
        ->setFasyankesId('1000119617') // TODO: cannot be hardcoded, proses di ambil dari puskesmas, boleh kembali di database
        ->setJenisFasyankesId('1') // // TODO: conditional, proses di ambil dari puskesmas 1 = puskesmas, 2 = rumah sakit, 3 = klinik
        ->setTerdugaTbId('1') // todo: diambil dari input /database
        ->setTerdugaRoId(null) // todo: hanya diisi ketika id = 2, diambil dari input / database
        ->setTipePasienId('1'); //

    /** Note: if you want to reduce time while execute the process, you can move script bellow into queue */
    $kunjungan = '2024-05-24 09:27:26.405593+07';
    $service = new MediatorService(
        Diagnosis::class,
        '10000004',
        'ef011065-38c9-46f8-9c35-d1fe68966a3e',
        'N10000001',
        $kunjungan,
        $tbSuspect,
        $patient
    );

    $response = $service->sendHasilLab($input);
    if ($response instanceof SubmitResponse) {
        $service->storeSatuSehat($response, $hasilLabModel, [
            'kunjungan' => $kunjungan,
            'pasien' => $patient->getNik(),
            'faskes' => '',
        ]);
    }
}