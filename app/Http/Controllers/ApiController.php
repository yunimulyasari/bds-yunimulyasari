<?php 

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller {

	public function index()
	{
    $client = new Client();
    $credentials = 'LdT23Q9rv8g9bVf8v/fQYsyIcuD14svaYL6Bi8f9uGhLBVlHA3ybTFjjqe+cQO8k';

    $urlKel = "http://api.jakarta.go.id/v1/kelurahan";
    $urlRs = "http://api.jakarta.go.id/v1/rumahsakitumum";

    $count = 0;

    $responseKel = $client->get($urlKel, [
        'headers'=> ['Authorization' => $credentials],
    ]);

    $responseRs = $client->get($urlRs, [
        'headers'=> ['Authorization' => $credentials],
    ]);

    $dataKel = json_decode($responseKel->getBody()->getContents(), true); 

    $dataRs = json_decode($responseRs->getBody()->getContents(), true);

    foreach ($dataRs['data'] as $valueRs) {
      foreach ($dataKel['data'] as $valueKel) {
        
        if ($valueKel['kode_kelurahan'] == $valueRs['kode_kelurahan']) {
          
          $dataNew[] = [
              'id' => $valueRs['id'],
              'nama_rsu' => $valueRs['nama_rsu'],
              'jenis_rsu' => $valueRs['jenis_rsu'],
              'location' => [
                'latitude' => $valueRs['latitude'],
                'longitude' => $valueRs['longitude'],
              ],
              'alamat' => $valueRs['location']['alamat'],
              'kode_pos' => $valueRs['kode_pos'],
              'telepon' => $valueRs['telepon'],
              'faximile' => $valueRs['faximile'],
              'website' => $valueRs['website'],
              'email' => $valueRs['email'],
              'kelurahan' => [
                'kode' => $valueRs['kode_kelurahan'],
                'nama' => $valueKel['nama_kelurahan'],
              ],
              'kecamatan' => [
                'kode' => $valueRs['kode_kecamatan'],
                'nama' => $valueKel['nama_kecamatan'],
              ],
              'kota' => [
                'kode' => $valueRs['kode_kota'],
                'nama' => $valueKel['nama_kota'],
              ],
          ];

          $dataJoin = array_slice($dataNew, 0, 5);

          $count= count($dataJoin);

          $result = [
            'status' => 'success',
            'count' => $count,
            'data'  => $dataJoin
          ];
        }
      }
    }

    return response()->json($result);

	}

}
