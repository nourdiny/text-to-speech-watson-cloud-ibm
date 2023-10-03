<?php

namespace App\Livewire;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

use App\Models\Audio;
use App\Models\User;
use Livewire\Component;
use GuzzleHttp\Client;

class Audios extends Component 
{
    public $audios;
    public $allaudios;
    public $class = TRUE;
    public $voice = "en-GB_CharlotteV3Voice";
    public $textPost = '';

    public $voices = [
        "English (United Kingdom)" => [
            "Female" => [
                "en-GB_CharlotteV3Voice" => "GA",
                "en-GB_KateV3Voice" => "GA"
            ],
            "Male" => [
                "en-GB_JamesV3Voice" => "GA"
            ]
        ],
        "Dutch (Netherlands)" => [
            "Female" => [
                "nl-NL_MerelV3Voice" => "Beta" 
            ]
        ],
        "English (United States)" => [
            "Female" => [
                "en-US_AllisonV3Voice" => "GA",
                "en-US_EmilyV3Voice" => "GA",
                "en-US_LisaV3Voice" => "GA",
                "en-US_OliviaV3Voice" => "GA"
            ],
            "Male" => [
                "en-US_HenryV3Voice" => "GA",
                "en-US_KevinV3Voice" => "GA",
                "en-US_MichaelV3Voice" => "GA"
            ]
        ],
        "French (Canadian)" => [
            "Female" => [
                "fr-CA_LouiseV3Voice" => "GA"
            ]
        ],
        "French (France)" => [
            "Female" => [
                "fr-FR_ReneeV3Voice" => "GA"
            ],
            "Male" => [
                "fr-FR_NicolasV3Voice" => "GA"
            ]
        ],
        "German" => [
            "Female" => [
                "de-DE_BirgitV3Voice" => "GA",
                "de-DE_ErikaV3Voice" => "GA"
            ],
            "Male" => [
                "de-DE_DieterV3Voice" => "GA"
            ]
        ],
        "Italian" => [
            "Female" => [
                "it-IT_FrancescaV3Voice" => "GA"
            ]
        ],
        "Japanese" => [
            "Female" => [
                "ja-JP_EmiV3Voice" => "GA"
            ]
        ],
        "Korean" => [
            "Female" => [
                "ko-KR_JinV3Voice" => "GA"
            ]
        ],
        "Portuguese (Brazilian)" => [
            "Female" => [
                "pt-BR_IsabelaV3Voice" => "GA"
            ]
        ],
        "Spanish (Castilian)" => [
            "Female" => [
                "es-ES_LauraV3Voice" => "GA"
            ],
            "Male" => [
                "es-ES_EnriqueV3Voice" => "GA"
            ]
        ],
        "Spanish (Latin American)" => [
            "Female" => [
                "es-LA_SofiaV3Voice" => "GA"
            ]
        ],
        "Spanish (North American)" => [
            "Female" => [
                "es-US_SofiaV3Voice" => "GA"
            ]
        ]
    ];
    
    

    public function save(){
        $this->validate([
            'textPost'    => 'required',
        ]);
        $apiKey = 'tfz6Eb3kmltr_s_IvESjaVQPX1dj7JK4NpYrddi_a1Cp';
        $url = 'https://api.eu-gb.text-to-speech.watson.cloud.ibm.com/instances/0845e801-c797-488d-86db-be45db818da8';
        $client = new Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'audio/wav',
            'Authorization' => 'Basic ' . base64_encode("apikey:$apiKey"),
        ];
        $data = [
            'text' => $this->textPost,
        ];
        $response = $client->request('POST', "$url/v1/synthesize?voice=".$this->voice, [
            'headers' => $headers,
            'json' => $data,
        ]);
        $namefile = 'myfile_'.date('m-d-Y_hia');
        $audioContents = $response->getBody()->getContents();
        Storage::disk('local')->put('public/'.$namefile.'.wav', $audioContents);
        Audio::create([
            "content" => $this->textPost,
            "userId" => Auth::user()->id,
            "path_audio" => $namefile.'.wav'
        ]);

        return redirect('/');
    }

    public function delete($id){
        $deletAudio = Audio::find($id);
        if (Storage::disk('public')->exists($deletAudio->path_audio)) {
            Storage::disk('public')->delete($deletAudio->path_audio);        }
        $deletAudio->delete();
    }

    public function render()
    {

            $this->allaudios = Audio::where('userId', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->get();

            $currentDateTime = Carbon::now();
            $formattedCurr = $currentDateTime->format('Y-m-d H:i:s');
            $oneDayAgo = $currentDateTime->subDay();
            $formattedDay = $oneDayAgo->format('Y-m-d H:i:s');
            $this->audios = Audio::where('userId', Auth::user()->id)
            ->whereDate('updated_at', '>=', $formattedDay)
            ->whereDate('updated_at', '<=', $formattedCurr)
            ->orderBy('id', 'desc')
            ->get();

        return view('livewire.Audios');
    }
}
