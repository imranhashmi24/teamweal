<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\InvestmentOpportunityCategory;
use App\Models\InvestmentOpportunity;

class InvestmentOpportunitiesSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                "title" => "Startups & Small Enterprises",
                "title_ar" => "الشركات الناشئة والمنشآت الصغيرة",
                "investments" => [
                    ["title" => "Digital apps & innovative platforms", "title_ar" => "تطبيقات رقمية ومنصات مبتكرة"],
                    ["title" => "E-commerce & quick-service projects", "title_ar" => "التجارة الإلكترونية والخدمات السريعة"],
                    ["title" => "Financial technology (Fintech)", "title_ar" => "التقنيات المالية (Fintech)"],
                    ["title" => "Incubators and accelerators", "title_ar" => "الحاضنات والمسرّعات"],
                    ["title" => "Student-led & early-stage ideas", "title_ar" => "المشاريع الطلابية والأفكار الريادية"],
                    ["title" => "Subscription-based SaaS models", "title_ar" => "مشاريع تعتمد نموذج الاشتراك الشهري (SaaS)"],
                ]
            ],
            [
                "title" => "Real Estate Funds",
                "title_ar" => "الصناديق العقارية",
                "investments" => [
                    ["title" => "Residential real estate funds", "title_ar" => "صناديق عقارية سكنية"],
                    ["title" => "Commercial & office development funds", "title_ar" => "صناديق تطوير تجاري ومكتبي"],
                    ["title" => "Hospitality & tourism real estate funds", "title_ar" => "صناديق فندقية وسياحية"],
                    ["title" => "Developed land investment portfolios", "title_ar" => "صناديق أراضي مطورة"],
                    ["title" => "Urban development and REITs", "title_ar" => "صناديق تطوير عمراني"],
                    ["title" => "Real estate Sukuks & crowdfunding", "title_ar" => "صكوك عقارية وتمويل عقاري جماعي"],
                ]
            ],
            [
                "title" => "Green & Sustainable Projects",
                "title_ar" => "المشاريع الخضراء والمستدامة",
                "investments" => [
                    ["title" => "Solar and renewable energy ventures", "title_ar" => "مشاريع الطاقة الشمسية والمتجددة"],
                    ["title" => "Recycling and waste management solutions", "title_ar" => "مشاريع التدوير وإدارة النفايات"],
                    ["title" => "Smart & organic agriculture", "title_ar" => "الزراعة الذكية والعضوية"],
                    ["title" => "Water conservation & environmental projects", "title_ar" => "مشاريع الحفاظ على المياه والبيئة"],
                    ["title" => "Green transport & electric mobility", "title_ar" => "النقل الأخضر والمركبات الكهربائية"],
                    ["title" => "Eco-friendly and sustainable products", "title_ar" => "منتجات مستدامة وصديقة للبيئة"],
                ]
            ],
            [
                "title" => "Industrial & Innovation Projects",
                "title_ar" => "الصناعة والابتكار",
                "investments" => [
                    ["title" => "Local manufacturing initiatives", "title_ar" => "مشاريع التصنيع المحلي"],
                    ["title" => "Industrial transformation & processing", "title_ar" => "مشاريع الصناعات التحويلية"],
                    ["title" => "Artificial intelligence in industry", "title_ar" => "الذكاء الاصطناعي في الصناعة"],
                    ["title" => "Robotics and automation", "title_ar" => "الروبوتات والأتمتة"],
                    ["title" => "Food & pharmaceutical industries", "title_ar" => "الصناعات الغذائية والدوائية"],
                    ["title" => "Light and medium manufacturing", "title_ar" => "الصناعات الخفيفة والمتوسطة"],
                    ["title" => "Smart & future-ready industrial solutions", "title_ar" => "حلول صناعية ذكية ومستقبلية"],
                ]
            ],
            [
                "title" => "Technology & Digital Platforms",
                "title_ar" => "التقنية والمنصات الرقمية",
                "investments" => [
                    ["title" => "AI and data analytics solutions", "title_ar" => "الذكاء الاصطناعي وتحليل البيانات"],
                    ["title" => "Cybersecurity and system protection", "title_ar" => "الأمن السيبراني وحماية الأنظمة"],
                    ["title" => "E-learning and digital training platforms", "title_ar" => "منصات التعليم والتدريب الرقمي"],
                    ["title" => "SaaS and business software solutions", "title_ar" => "حلول SaaS وأنظمة الأعمال"],
                    ["title" => "Mobile apps and wearables", "title_ar" => "تطبيقات الجوال والأجهزة القابلة للارتداء"],
                    ["title" => "Blockchain and digital assets", "title_ar" => "تقنيات البلوكتشين والعملات الرقمية"],
                    ["title" => "Internet of Things (IoT) and smart control", "title_ar" => "إنترنت الأشياء (IoT) والتحكم الذكي"],
                ]
            ],
            [
                "title" => "Social Impact Projects",
                "title_ar" => "المشاريع ذات الأثر الاجتماعي",
                "investments" => [
                    ["title" => "Education and vocational training", "title_ar" => "التعليم والتأهيل المهني"],
                    ["title" => "CSR-based investments", "title_ar" => "استثمارات المسؤولية الاجتماعية"],
                    ["title" => "Women and youth empowerment", "title_ar" => "تمكين المرأة والشباب"],
                    ["title" => "Projects targeting low-income groups", "title_ar" => "مشاريع الفئات محدودة الدخل"],
                    ["title" => "Non-profit and community partnerships", "title_ar" => "شراكات مجتمعية وغير ربحية"],
                    ["title" => "Social innovation and development", "title_ar" => "الابتكار الاجتماعي والتنموي"],
                ]
            ],
            [
                "title" => "Financing Opportunities & Sukuks",
                "title_ar" => "الفرص التمويلية والصكوك",
                "investments" => [
                    ["title" => "Investment in Islamic Sukuk", "title_ar" => "الاستثمار في الصكوك الإسلامية"],
                    ["title" => "Short- and Long-Term Debt Instruments", "title_ar" => "أدوات الدين قصيرة وطويلة الأجل"],
                    ["title" => "Debt Crowdfunding", "title_ar" => "التمويل الجماعي بالدين"],
                    ["title" => "Angel Investing", "title_ar" => "الاستثمار الملائكي"],
                    ["title" => "Supply Chain & Invoice Financing", "title_ar" => "تمويل سلسلة الإمداد والفواتير"],
                    ["title" => "Innovative Trade Finance Solutions", "title_ar" => "حلول تمويل تجاري مبتكرة"],
                    ["title" => "Murabaha, Istisna, and Lease Financing", "title_ar" => "مرابحة، استصناع، تأجير تمويلي"],
                    ["title" => "Marketing of Debt Instruments and Funds", "title_ar" => "تسويق أدوات الدين والصناديق"],
                    ["title" => "Auctions", "title_ar" => "المزادات"],
                ]
            ],
        ];

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        InvestmentOpportunity::truncate();
        InvestmentOpportunityCategory::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        foreach ($categories as $catData) {
            $category = new InvestmentOpportunityCategory();
            $category->title = $catData['title'];
            $category->title_ar = $catData['title_ar'];
            $category->save();

            if (!empty($catData['investments'])) {
                foreach ($catData['investments'] as $invData) {
                    $investment = new InvestmentOpportunity();
                    $investment->title = $invData['title'];
                    $investment->title_ar = $invData['title_ar'];
                    $investment->category_id = $category->id;
                    $investment->save();
                }
            }
        }

        $this->command->info("Investment opportunities seeded successfully!");
    }
}
