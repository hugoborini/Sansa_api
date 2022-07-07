<?php

namespace App\Controller\Bo;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminAssoController extends AbstractController
{
    /**
     * @Route("bo/admin/asso", name="app_admin_asso")
     */
    public function index(): Response
    {
        return $this->render('views/admin/association.html.twig', [
            'controller_name' => 'AdminAssoController',
            'title' => 'Associations',
            'currentPage' => 'association',
            'assos' => [
                "0" => [
                    "name" => "Associations coeur",
                    "siret" => "76354000981233",
                    "asking_date" => "05/03/2022",
                    "rna" => "W00",
                    "contact" => [
                        "tel" => "0786831179",
                        "email" => "hcordillot@gmil.com"
                    ],
                    "status" => true,
                    "notation" => 3
                ],
                "1" => [
                    "name" => "À vos ok soins",
                    "siret" => "76354000981233",
                    "asking_date" => "05/03/2022",
                    "rna" => "W00",
                    "contact" => [
                        "tel" => "0786831179",
                        "email" => "hcordillot@gmil.com"
                    ],
                    "status" => false,
                    "notation" => 3
                ],
                "2" => [
                    "name" => "À vos soins association",
                    "siret" => "76354000981233",
                    "asking_date" => "05/03/2022",
                    "rna" => "W00",
                    "contact" => [
                        "tel" => "0786831179",
                        "email" => "hcordillot@gmil.com"
                    ],
                    "status" => false,
                    "notation" => 3
                ],
                "3" => [
                    "name" => "Main dans la main et so...",
                    "siret" => "76354000981233",
                    "asking_date" => "05/03/2022",
                    "rna" => "W00",
                    "contact" => [
                        "tel" => "0786831179",
                        "email" => "hcordillot@gmil.com"
                    ],
                    "status" => false,
                    "notation" => 3
                ],
                "4" => [
                    "name" => "Main dans la main et so.ok",
                    "siret" => "76354000981233",
                    "asking_date" => "05/03/2022",
                    "rna" => "W00",
                    "contact" => [
                        "tel" => "0786831",
                        "email" => "hcordillot@gmil.com"
                    ],
                    "status" => true,
                    "notation" => 3
                ],
                "5" => [
                    "name" => "Main dans la main et so...",
                    "siret" => "76354000981233",
                    "asking_date" => "05/03/2022",
                    "rna" => "W00",
                    "contact" => [
                        "tel" => "0786831179",
                        "email" => "hcordillot@gmil.com"
                    ],
                    "status" => false,
                    "notation" => 3
                ],
                "6" => [
                    "name" => "À vos soins association",
                    "siret" => "76354000981233",
                    "asking_date" => "05/03/2022",
                    "rna" => "W00",
                    "contact" => [
                        "tel" => "0786831179",
                        "email" => "hcordillot@gmil.com"
                    ],
                    "status" => false,
                    "notation" => 3
                ],
                "7" => [
                    "name" => "Main dans la main et so...",
                    "siret" => "76354000981233",
                    "asking_date" => "05/03/2022",
                    "rna" => "W00",
                    "contact" => [
                        "tel" => "0786831179",
                        "email" => "hcordillot@gmil.com"
                    ],
                    "status" => false,
                    "notation" => 3
                ],
                "8" => [
                    "name" => "Main dans la main et so.ok",
                    "siret" => "76354000981233",
                    "asking_date" => "05/03/2022",
                    "rna" => "W00",
                    "contact" => [
                        "tel" => "0786831",
                        "email" => "hcordillot@gmil.com"
                    ],
                    "status" => true,
                    "notation" => 3
                ],
                "9" => [
                    "name" => "Main dans la main et so...",
                    "siret" => "76354000981233",
                    "asking_date" => "05/03/2022",
                    "rna" => "W00",
                    "contact" => [
                        "tel" => "0786831179",
                        "email" => "hcordillot@gmil.com"
                    ],
                    "status" => false,
                    "notation" => 3
                ]
            ]
        ]);
    }
}
