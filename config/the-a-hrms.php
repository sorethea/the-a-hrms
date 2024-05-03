<?php
$years = range(now()->subYear(30)->format('Y'),now()->format('Y'));
return [
    "outype"=>[
        "division"=>"Division",
        "department"=>"Department",
        "unit"=>"Unit"
    ],
    "gender"=>[
        "Male",
        "Female"
    ],
    "marital-status"=>[
        "Single",
        "Marriage",
        "Divorce",
        "Other"
    ],
    "leave"=>[
        "status"=>[
            "pending"=>"Pending",
            "approved"=>"Approved",
            "rejected"=>"Rejected",
            "cancelled"=>"Cancelled",
        ],
        "type"=>[
            "sick_leave"=>"Sick Leave",
            "annual_leave"=>"Annual Leave"
        ],
    ],
    "years"=>array_combine($years,$years)
];
