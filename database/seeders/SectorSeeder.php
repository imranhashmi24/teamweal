<?php

namespace Database\Seeders;

use App\Models\Sector;
use App\Models\SectorForm;
use App\Models\SectorList;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sectors = [
            [
                "title" => "Saudi Fund for Development",
                "title_ar" => "الصندوق السعودي للتنمية",
                "type" => "default",
                "description" => "",
                "description_ar" => "",
                "status" => "active",
            ],
            [
                "title" => "Agricultural Development Fund",
                "title_ar" => "صندوق التنمية الزراعية",
                "type" => "default",
                "description" => "",
                "description_ar" => "",
                "status" => "active",
            ],
            [
                "title" => "Social Development Bank",
                "title_ar" => "بنك التنمية الاجتماعية",
                "type" => "default",
                "description" => "",
                "description_ar" => "",
                "status" => "active",
            ],
            [
                "title" => "Cultural Development Fund",
                "title_ar" => "صندوق التنمية الثقافي",
                "type" => "default",
                "description" => "",
                "description_ar" => "",
                "status" => "active",
            ],
            [
                "title" => "Tourism Development Fund",
                "title_ar" => "صندوق التنمية السياحي",
                "type" => "default",
                "description" => "",
                "description_ar" => "",
                "status" => "active",
            ],
            [
                "title" => "Saudi Industrial Development Fund",
                "title_ar" => "صندوق التنمية الصناعية السعودي",
                "type" => "default",
                "description" => "",
                "description_ar" => "",
                "status" => "active",
            ],
            [
                "title" => "Human Resources Development Fund",
                "title_ar" => "صندوق تنمية الموارد البشرية",
                "type" => "default",
                "description" => "",
                "description_ar" => "",
                "status" => "active",
            ],
            [
                "title" => "Real Estate Development Fund",
                "title_ar" => "صندوق التنمية العقارية",
                "type" => "default",
                "description" => "",
                "description_ar" => "",
                "status" => "active",
            ],
            [
                "title" => "Investment Events Fund",
                "title_ar" => "صندوق الفعاليات الاستثماري",
                "type" => "default",
                "description" => "",
                "description_ar" => "",
                "status" => "active",
            ],
            [
                "title" => "Small and Medium Enterprises Bank",
                "title_ar" => "بنك المنشآت الصغيرة والمتوسطة",
                "type" => "default",
                "description" => "",
                "description_ar" => "",
                "status" => "active",
            ],
            [
                "title" => "National Infrastructure Fund",
                "title_ar" => "صندوق البنية التحتية الوطني",
                "type" => "default",
                "description" => "",
                "description_ar" => "",
                "status" => "active",
            ],
            [
                "title" => "Saudi Export-Import Bank",
                "title_ar" => "بنك التصدير والاستيراد السعودي",
                "type" => "default",
                "description" => "",
                "description_ar" => "",
                "status" => "active",
            ],
            [
                "title" => "Agriculture sector",
                "title_ar" => "قطاع الزراعة",
                "type" => "private",
                "description" => "Financing the agricultural sector is one of the basic pillars of supporting the economy and increasing capital.",
                "description_ar" => "يعد تمويل القطاع الزراعي احد الركائز الاساسية لدعم الاقتصاد وزيادة رأس المال.",
                "status" => "active",
            ],
            [
                "title" => "Agricultural Development Fund",
                "title_ar" => "صندوق التنمية الزراعية",
                "type" => "private",
                "description" => "It is represented in contributing to the development of the agricultural sector and raising its production efficiency by providing soft, interest-free loans to farmers to secure what is necessary to achieve this activity.",
                "description_ar" => "يتمثل في الإسهام في تنمية القطاع الزراعي، ورفع كفاءته الإنتاجية وذلك عن طريق تقديم قروض ميسرة بدون فوائد للمزارعين لتأمين ما يلزم لتحقيق هذا النشاط",
                "status" => "active",
            ],
        
            [
                "title" => "Social Development Bank",
                "title_ar" => "بنك التنمية الاجتماعية",
                "type" => "private",
                "description" => "The Social Development Bank provides financing and non-financial services to micro-projects, associations, and civil society institutions, and loans to emerging enterprises, in addition to providing social financing for people with limited income. The bank also works to provide technical and administrative services, and encourage savings for individuals and institutions in the Kingdom.",
                "description_ar" => "يقدم بنك التنمية الاجتماعية تمويل وخدمات غير مالية للمشاريع المتناهية الصغر، وللجمعيات، والمؤسسات الأهلية، وقروض للمنشآت الناشئة، بالإضافة إلى توفير التمويل الاجتماعي لذوي الدخل المحدود كما يعمل البنك على تقديم خدمات فنية وإدارية، وتشجيع الادخار للأفراد والمؤسسات في المملكة",
                "status" => "active",
            ],
        
            // SECTOR: Industria
            [
                "title" => "Industrial sector",
                "title_ar" => "الصندوق الصناعي",
                "type" => "private",
                "description" => "Financing the industrial sector has a role in creating job opportunities and supporting economic growth rates.",
                "description_ar" => "تمويل القطاع الصناعي له دوره في خلق فرص العمل ودعم معدلات النمو الاقتصادي",
                "status" => "active",
            ],
            [
                "title" => "Saudi Industrial Development Fund",
                "title_ar" => "صندوق التنمية الصناعية السعودي",
                "type" => "private",
                "description" => "To enhance industrial investment opportunities, develop local industry and raise the level of its performance, by contributing to the formation of industrial sectors, developing competitive institutions, supporting strategic initiatives, and providing innovative solutions; To grow and develop the local industry and raise its performance.",
                "description_ar" => "لتعزيز فرص الاستثمار الصناعي، وتطوير الصناعة المحلية ورفع مستوى أدائها، من خلال الإسهام في تشكيل القطاعات الصناعية، وتطوير المؤسسات التنافسية، ودعم المبادرات الاستراتيجية، وتقديم الحلول المبتكرة؛ لنمو وتطوير الصناعة المحلية، ورفع أدائها",
                "status" => "active",
            ],
        
            [
                "title" => "Tourism Development Fund",
                "title_ar" => "صندوق التنمية السياحي",
                "type" => "private",
                "description" => "The Fund provides a wide range of appropriate solutions to meet the needs of various areas of tourism, especially to support projects that serve developing tourism areas in the Kingdom.",
                "description_ar" => "يوفر الصندوق مجموعة واسعة من الحلول المناسبة لتلبية احتياجات مختلف مجالات السياحة لا سيما لدعم المشاريع التي تخدم المناطق السياحية النامية في المملكة",
                "status" => "active",
            ],
        
            [
                "title" => "Small Enterprises Bank",
                "title_ar" => "بنك المنشآت الصغيرة",
                "type" => "private",
                "description" => "The Small and Medium Enterprises Bank seeks to facilitate access to financing for sectors promising to provide services and products through digital channels. To enhance the contributions of financial institutions in financing the small and medium enterprises sector by empowering them and integrating with them the Kafalah Program, the financing guarantee program for small and medium enterprises.",
                "description_ar" => "بنك المنشآات الصغيرة و المتوسطة يسعى إلى تسهيل الوصول للتمويل للقطاعات الواعدة بتقديم الخدمات والمنتجات عبر القنوات الرقمية؛ لتعزيز إسهامات المؤسسات المالية في تمويل قطاع المنشآت الصغيرة والمتوسطة عبر تمكينها والتكامل معها  برنامج كفالة, برنامج ضمان التمويل للمنشآت الصغيرة والمتوسطة",
                "status" => "active",
            ],
        
            [
                "title" => "Real Estate Development Fund",
                "title_ar" => "صندوق التنمية العقارية",
                "type" => "private",
                "description" => "Financing the real estate sector contributes to providing job and investment opportunities and achieving economic and social growth.",
                "description_ar" => "يساهم تمويل قطاع العقارات في توفير فرص العمل والاستثمار وتحقيق النمو الاقتصادي والاجتماعي",
                "status" => "active",
            ],
        
            [
                "title" => "Export-Import Bank",
                "title_ar" => "بنك التصدير والاستيراد",
                "type" => "private",
                "description" => "Financing the export sector has an essential role in promoting economic growth and raising the productivity of goods and services.",
                "description_ar" => "تمويل قطاع الصادرات له دور اساسي في تعزيز النمو الاقتصادي والرفع من انتاجية السلع والخدمات",
                "status" => "active",
            ],
        
            // SECTOR: National Infrastructure
            [
                "title" => "National Infrastructure Fund",
                "title_ar" => "صندوق البنية التحتية الوطني",
                "type" => "private",
                "description" => "It works to enable and accelerate strategic infrastructure projects in the Kingdom, enhance the quality of life of the individual and society, and encourage partnership with the private sector by motivating local and international investors and attracting them to participate and invest in the implementation of quality infrastructure projects through a package of valuable products and innovative solutions whose impact will be reflected in deepening infrastructure financing markets. Infrastructure in the Kingdom",
                "description_ar" => "يعمل على تمكين مشاريع البنية التحتية الإستراتيجية بالمملكة وتسريعها وتعزيز جودة حياة الفرد والمجتمع وتشجيع الشراكة مع القطاع الخاص من خلال تحفيز المستثمرين المحليين والدوليين وجذبهم للمشاركة والاستثمار في تنفيذ مشاريع البنية التحتية النوعية وذلك عبر حزمة من المنتجات القيمة والحلول المبتكرة التي سينعكس أثرها على تعميق أسواق تمويل البنية التحتية في المملكة",
                "status" => "active",
            ],
        
            [
                "title" => "Events Investment Fund",
                "title_ar" => "صندوق الفعاليات الاستثماري",
                "type" => "private",
                "description" => "The Events Investment Fund aims to develop world-class events infrastructure; To support the entertainment, tourism, culture, and sports sectors in the Kingdom of Saudi Arabia; By working with the private sector, ensuring sustainability.",
                "description_ar" => "صندوق الفعاليات الاستثماري يهدف إلى تطوير بنية تحتية للفعاليات على مستوى عالمي؛ لدعم قطاعات الترفيه، والسياحة، والثقافة، والرياضة في المملكة العربية السعودية؛ من خلال العمل مع القطاع الخاص، وضمان الاستدامة",
                "status" => "active",
            ],
        
            [
                "title" => "Human Resources Development Fund",
                "title_ar" => "صندوق تنمية الموارد البشرية",
                "type" => "private",
                "description" => "The Human Resources Development Fund aims to focus efforts; To raise the skills of national human cadres by qualifying them, providing them with knowledge, and aligning them with the needs of the labor market and jobs by providing work and services to beneficiaries, taking into account their needs and requirements.",
                "description_ar" => "صندوق تنمية الموارد البشرية يهدف إلى تركيز الجهود؛ لرفع مهارات الكوادر البشرية الوطنية بتأهيلها وتزويدها بالمعرفة، وموائمتها مع احتياجات سوق العمل والوظائف عبر تقديم الأعمال والخدمات للمستفيدين، تراعي احتياجاتهم ومتطلباتهم",
                "status" => "active",
            ],
        
            [
                "title" => "Cultural Fund",
                "title_ar" => "الصندوق الثقافي",
                "type" => "private",
                "description" => "The Fund will contribute to enhancing Saudi cultural production and achieving economic development opportunities, leading to the development of the cultural scene and raising the level of appreciation for national culture locally and globally.",
                "description_ar" => "سيساهم الصندوق بتعزيز الإنتاج الثقافي السعودي وتحقيق فرص اقتصادية تنموية مما يؤدي إلى تطوير المشهد الثقافي ورفع منسوب تقدير الثقافة الوطنية محليًا وعالميًا",
                "status" => "active",
            ],
            [
                "title" => "Working Capital Financing",
                "title_ar" => "تمويل رأس المال العامل",
                "type" => "financial",
                "description" => "",
                "description_ar" => "",
                "status" => "active",
            ],
            [
                "title" => "Industrial Equipment Financing",
                "title_ar" => "تمويل المعدات الصناعية",
                "type" => "financial",
                "description" => "",
                "description_ar" => "",
                "status" => "active",
            ],
            [
                "title" => "Trade Financing",
                "title_ar" => "التمويل التجاري",
                "type" => "financial",
                "description" => "",
                "description_ar" => "",
                "status" => "active",
            ],
            [
                "title" => "Commercial Loans",
                "title_ar" => "القروض التجارية",
                "type" => "financial",
                "description" => "",
                "description_ar" => "",
                "status" => "active",
            ],
            [
                "title" => "Logistics Financing",
                "title_ar" => "تمويل الخدمات اللوجستية",
                "type" => "financial",
                "description" => "",
                "description_ar" => "",
                "status" => "active",
            ],
            [
                "title" => "Invoice Financing",
                "title_ar" => "تمويل الفواتير",
                "type" => "financial",
                "description" => "",
                "description_ar" => "",
                "status" => "active",
            ],
            [
                "title" => "Medical Equipment Financing",
                "title_ar" => "تمويل المعدات الطبية",
                "type" => "financial",
                "description" => "",
                "description_ar" => "",
                "status" => "active",
            ],
            [
                "title" => "Point of Sale Financing",
                "title_ar" => "تمويل نقاط البيع",
                "type" => "financial",
                "description" => "",
                "description_ar" => "",
                "status" => "active",
            ],
            [
                "title" => "Receivables Financing",
                "title_ar" => "تمويل المستحقات",
                "type" => "financial",
                "description" => "",
                "description_ar" => "",
                "status" => "active",
            ],
            [
                "title" => "Insurance",
                "title_ar" => "التأمين",
                "type" => "financial",
                "description" => "",
                "description_ar" => "",
                "status" => "active",
            ],
            [
                "title" => "Flight Booking Platforms",
                "title_ar" => "منصات حجوزات الطيران",
                "type" => "financial",
                "description" => "",
                "description_ar" => "",
                "status" => "active",
            ],
            [
                "title" => "Education",
                "title_ar" => "التعليم",
                "type" => "financial",
                "description" => "",
                "description_ar" => "",
                "status" => "active",
            ],
            [
                "title" => "Providing an electronic payment gateway for purchases through the platform",
                "title_ar" => "توفير بوابة دفع إلكتروني للمشتريات عبر المنصة",
                "type" => "financial",
                "description" => "",
                "description_ar" => "",
                "status" => "active",
            ]
        ];



        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        Sector::truncate();
        SectorList::truncate();
        SectorForm::truncate();
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        foreach ($sectors as $sector) {
            $s = new Sector();
            
            $s->title = $sector['title'];
            $s->title_ar = $sector['title_ar'];
            $s->type = $sector['type'];
            $s->description = $sector['description'];
            $s->description_ar = $sector['description_ar'];
            $s->status = $sector['status'];
            $s->save();
        }
    }
}
