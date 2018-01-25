<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\AuthorizationCodes;
use App\AccessTokens;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->middleware('auth');

    }

    public function getQuestPaths() {
        $app->post('roles', 'StudentController@onceoff');

        $jsonInput = '
            [
                {
                    "user_id": 1,
                    "quest_paths": [
                        {
                            "order": 0,
                            "quest": {
                                "id": 1,
                                "name": "Curiosity - The Space Rover"
                            },
                            "mark": {
                                "submitted": true,
                                "completion": 100,
                                "mark": 100
                            }
                        },
                        {
                            "order": 1,
                            "quest": {
                                "id": 2,
                                "name": "The 4 Hour Work Week",
                                "is_active": false
                            },
                            "mark": {
                                "submitted": true,
                                "completion": 55,
                                "mark": null
                            }
                        },
                        {
                            "order": 2,
                            "quest": {
                                "id": 3,
                                "name": "Let\'s Learn about Economics"
                            },
                            "mark": {
                                "submitted": true,
                                "completion": 27,
                                "mark": 10
                            }
                        }
                    ]
                },
                {
                    "user_id": 2,
                    "quest_paths": [
                        {
                            "order": 0,
                            "quest": {
                                "id": 2,
                                "name": "The 4 Hour Work Week",
                                "is_active": false
                            },
                            "mark": {
                                "submitted": true,
                                "completion": 75,
                                "mark": null
                            }
                        },
                        {
                            "order": 1,
                            "quest": {
                                "id": 3,
                                "name": "Let\'s Learn about Economics"
                            },
                            "mark": {
                                "submitted": false,
                                "completion": 0,
                                "mark": null
                            }
                        }
                    ]
                },
                {
                    "user_id": 3,
                    "quest_paths": [
                        {
                            "order": 0,
                            "quest": {
                                "id": 1,
                                "name": "Curiosity - The Space Rover"
                            },
                            "mark": {
                                "submitted": true,
                                "completion": 85,
                                "mark": 15
                            }
                        },
                        {
                            "order": 1,
                            "quest": {
                                "id": 3,
                                "name": "Let\'s Learn about Economics"
                            },
                            "mark": {
                                "submitted": false,
                                "completion": 0,
                                "mark": null
                            }
                        }
                    ]
                },
                {
                    "user_id": 4,
                    "quest_paths": [
                        {
                            "order": 0,
                            "quest": {
                                "id": 1,
                                "name": "Curiosity - The Space Rover"
                            },
                            "mark": {
                                "submitted": true,
                                "completion": 67,
                                "mark": 80
                            }
                        },
                        {
                            "order": 1,
                            "quest": {
                                "id": 3,
                                "name": "Let\'s Learn about Economics"
                            },
                            "mark": {
                                "submitted": false,
                                "completion": 0,
                                "mark": null
                            }
                        }
                    ]
                },
                {
                    "user_id": 5,
                    "quest_paths": [
                        {
                            "order": 0,
                            "quest": {
                                "id": 1,
                                "name": "Curiosity - The Space Rover"
                            },
                            "mark": {
                                "submitted": true,
                                "completion": 100,
                                "mark": 100
                            }
                        },
                        {
                            "order": 1,
                            "quest": {
                                "id": 2,
                                "name": "The 4 Hour Work Week",
                                "is_active": false
                            },
                            "mark": {
                                "submitted": false,
                                "completion": 0,
                                "mark": null
                            }
                        },
                        {
                            "order": 2,
                            "quest": {
                                "id": 3,
                                "name": "Let\'s Learn about Economics"
                            },
                            "mark": {
                                "submitted": true,
                                "completion": 40,
                                "mark": 65
                            }
                        }
                    ]
                }
            ]
        ';

        $model = json_decode($jsonInput);

        $response = [
            'status' => 1,
            'data' => $model
        ];
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);

    }

    public function index()
    {
        $jsonInput = '
        [
            {
                "id": 1,
                "fullname": "Ryan Grey"
            },
            {
                "id": 2,
                "fullname": "Jacqueline Myers"
            },
            {
                "id": 3,
                "fullname": "Henry Bloggs"
            },
            {
                "id": 4,
                "fullname": "Michael McManns"
            },
            {
                "id": 5,
                "fullname": "Vanessa Riley"
            }
        ]
        ';

        $model = json_decode($jsonInput);

        $response = [
            'status' => 1,
            'data' => $model
        ];
        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }

}
