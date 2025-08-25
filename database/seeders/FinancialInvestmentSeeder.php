<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\FinancialInvestment;
use App\Models\FinancialInvestmentForm;
use App\Models\FinancialInvestmentList;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FinancialInvestmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $financial_investments = [
            [
                "title" => "Advanced Financing Services",
                "title_ar" => "خدمات التمويل المتقدمة",
                "lists" => [
                    ["title" => "Payroll Financing for Companies", "title_ar" => "تمويل الرواتب للشركات", "status" => "active"],
                    ["title" => "Credit Card Financing", "title_ar" => "تمويل بطاقات الائتمان", "status" => "active"],
                    ["title" => "Financing Against POS Collections", "title_ar" => "التمويل مقابل متحصلات نقاط البيع", "status" => "active"],
                    ["title" => "Contract Financing (Construction/Supply Contracts)", "title_ar" => "تمويل العقود (مقاولات/توريد)", "status" => "active"],
                    ["title" => "Financing Guarantee Programs (Kafalah, SME Guarantee)", "title_ar" => "برامج الضمان التمويلية (كفالة/ضمان المنشآت)", "status" => "active"],
                    ["title" => "Commercial Financing / Overdraft Facilities", "title_ar" => "التمويل التجاري / السحب على المكشوف", "status" => "active"],
                    ["title" => "Micro Consumer Financing", "title_ar" => "التمويل الاستهلاكي المصغر", "status" => "active"],
                    ["title" => "Long-Term Residential Financing", "title_ar" => "التمويل السكني طويل الأجل", "status" => "active"],
                    ["title" => "Industrial Land & Loan Program", "title_ar" => "برنامج أرض وقرض الصناعي", "status" => "active"],
                    ["title" => "Working Capital Financing", "title_ar" => "تمويل رأس المال العامل", "status" => "active"],
                    ["title" => "Equipment & Asset Financing", "title_ar" => "تمويل المعدات والأصول", "status" => "active"],
                    ["title" => "Industrial & Commercial Incentive Programs", "title_ar" => "برامج التحفيز الصناعي والتجاري", "status" => "active"],
                ],
                "forms" => [
                    [
                        "name" => "Basic Information",
                        "name_ar" => "معلومات أساسية",
                        "type" => "title",
                        "required" => "no",
                        "placeholder" => "",
                        "placeholder_ar" => "",
                        "options" => [],
                        "options_ar" => [],
                        "col" => "12",
                        "status" => "active"
                    ],
                    ["name" => "Company Name", "name_ar" => "اسم المنشأة", "type" => "text", "required" => "yes", "placeholder" => "", "placeholder_ar" => "", "options" => [], "options_ar" => [], "col" => "12", "status" => "active"],
                    ["name" => "Business Activity", "name_ar" => "نوع النشاط", "type" => "text", "required" => "yes", "placeholder" => "", "placeholder_ar" => "", "options" => [], "options_ar" => [], "col" => "12", "status" => "active"],
                    ["name" => "City / Region", "name_ar" => "المدينة / المنطقة", "type" => "text", "required" => "yes", "placeholder" => "", "placeholder_ar" => "", "options" => [], "options_ar" => [], "col" => "12", "status" => "active"],
                    ["name" => "Commercial Registration Number", "name_ar" => "رقم السجل التجاري", "type" => "text", "required" => "yes", "placeholder" => "", "placeholder_ar" => "", "options" => [], "options_ar" => [], "col" => "12", "status" => "active"],
                    ["name" => "Establishment Date", "name_ar" => "تاريخ التأسيس", "type" => "date", "required" => "yes", "placeholder" => "", "placeholder_ar" => "", "options" => [], "options_ar" => [], "col" => "12", "status" => "active"],
                    ["name" => "Number of Employees", "name_ar" => "عدد الموظفين", "type" => "number", "required" => "yes", "placeholder" => "", "placeholder_ar" => "", "options" => [], "options_ar" => [], "col" => "12", "status" => "active"],
                    [
                        "name" => "Contact Information",
                        "name_ar" => "معلومات الاتصال",
                        "type" => "title",
                        "required" => "no",
                        "placeholder" => "",
                        "placeholder_ar" => "",
                        "options" => [],
                        "options_ar" => [],
                        "col" => "12",
                        "status" => "active"
                    ],
                    ["name" => "Contact Person Name", "name_ar" => "اسم ممثل المنشأة", "type" => "text", "required" => "yes", "placeholder" => "", "placeholder_ar" => "", "options" => [], "options_ar" => [], "col" => "12", "status" => "active"],
                    ["name" => "Email Address", "name_ar" => "البريد الإلكتروني", "type" => "email", "required" => "yes", "placeholder" => "", "placeholder_ar" => "", "options" => [], "options_ar" => [], "col" => "12", "status" => "active"],
                    ["name" => "Mobile Number", "name_ar" => "رقم الجوال", "type" => "tel", "required" => "yes", "placeholder" => "", "placeholder_ar" => "", "options" => [], "options_ar" => [], "col" => "12", "status" => "active"],
                    ["name" => "Job Title", "name_ar" => "المسمى الوظيفي", "type" => "text", "required" => "yes", "placeholder" => "", "placeholder_ar" => "", "options" => [], "options_ar" => [], "col" => "12", "status" => "active"],
                    [
                        "name" => "Requested Service(s)",
                        "name_ar" => "الخدمة المطلوبة",
                        "type" => "title",
                        "required" => "no",
                        "placeholder" => "",
                        "placeholder_ar" => "",
                        "options" => [],
                        "options_ar" => [],
                        "col" => "12",
                        "status" => "active"
                    ],
                    ["name" => "Requested Service(s)", "name_ar" => "الخدمة المطلوبة", "type" => "checkbox", "required" => "yes", "placeholder" => "Select one or more financing services", "placeholder_ar" => "اختر واحدة أو أكثر من خدمات التمويل", "options" => [
                        "Payroll Financing for Companies",
                        "Credit Card Financing",
                        "Financing Against POS Collections",
                        "Contract Financing (Construction/Supply Contracts)",
                        "Financing Guarantee Programs (Kafalah, SME Guarantee)",
                        "Commercial Financing / Overdraft Facilities",
                        "Micro Consumer Financing",
                        "Long-Term Residential Financing",
                        "Industrial 'Land and Loan' Program",
                        "Working Capital Financing",
                        "Equipment & Asset Financing",
                        "Industrial and Commercial Incentive Programs"
                    ], "options_ar" => [
                        "تمويل الرواتب للشركات",
                        "تمويل بطاقات الائتمان",
                        "التمويل مقابل متحصلات نقاط البيع",
                        "تمويل العقود (مقاولات/توريد)",
                        "برامج الضمان التمويلية (كفالة/ضمان المنشآت)",
                        "التمويل التجاري / السحب على المكشوف",
                        "التمويل الاستهلاكي المصغر",
                        "التمويل السكني طويل الأجل",
                        "برنامج أرض وقرض الصناعي",
                        "تمويل رأس المال العامل",
                        "تمويل المعدات والأصول",
                        "برامج التحفيز الصناعي والتجاري"
                    ], "col" => "12", "status" => "active"],

                    [
                        "name" => "Requested Financing Amount",
                        "name_ar" => "مبلغ التمويل المطلوب",
                        "type" => "title",
                        "required" => "no",
                        "placeholder" => "",
                        "placeholder_ar" => "",
                        "options" => [],
                        "options_ar" => [],
                        "col" => "12",
                        "status" => "active"
                    ],

                    ["name" => "Requested Financing Amount", "name_ar" => "مبلغ التمويل المطلوب", "type" => "text", "required" => "no", "placeholder" => "", "placeholder_ar" => "", "options" => [], "options_ar" => [], "col" => "12", "status" => "active"],

                    ["name" => "Attachments", "name_ar" => "مرفقات", "type" => "file", "required" => "no", "placeholder" => "", "placeholder_ar" => "", "options" => ["Commercial Registration", "National ID / Authorized Person ID", "Company Profile or Introduction Letter", "Bank Statement (Last 3 Months - Optional)"], "options_ar" => ["السجل التجاري", "الهوية الوطنية / الهوية للمفوض", "خطاب تعريف بالمنشأة", "كشف حساب بنكي 3 أشهر (اختياري)"], "col" => "12", "status" => "active"],

                    ["name" => "Additional Notes", "name_ar" => "ملاحظات إضافية", "type" => "textarea", "required" => "no", "placeholder" => "", "placeholder_ar" => "", "options" => [], "options_ar" => [], "col" => "12", "status" => "active"],
                ],
                "status" => "active",
            ],
            [
                "title" => "Developmental & Investment Programs",
                "title_ar" => "البرامج التنموية والاستثمارية",
                "lists" => [
                    ["title" => "Tawteen Program", "title_ar" => "برنامج توطين", "status" => "active"],
                    ["title" => "Export Incentive Program", "title_ar" => "برنامج تحفيز الصادرات", "status" => "active"],
                    ["title" => "Employment Support Programs (Industrial / Tourism)", "title_ar" => "برامج دعم التوظيف (الصناعي/السياحي)", "status" => "active"],
                    ["title" => "\"Made in Saudi\" Program", "title_ar" => "برنامج صنع في السعودية", "status" => "active"],
                    ["title" => "Venture Investment Initiative", "title_ar" => "مبادرة الاستثمار الجرئ", "status" => "active"],
                    ["title" => "Startup Tech Financing", "title_ar" => "تمويل التقنية الناشئة", "status" => "active"],
                    ["title" => "Incubators & Accelerators Financing", "title_ar" => "تمويل حاضنات ومسرعات الأعمال", "status" => "active"],
                    ["title" => "Credit Facility Program for Enterprises", "title_ar" => "برنامج التسهيلات الائتمانية للمنشآت", "status" => "active"],
                    ["title" => "E-commerce Support Programs", "title_ar" => "برامج التجارة الإلكترونية", "status" => "active"],
                    ["title" => "Agricultural Support Program (Palm Farmers)", "title_ar" => "برنامج الدعم الزراعي للنخيل والمزارعين", "status" => "active"],
                    ["title" => "Jada 30", "title_ar" => "جادة 30", "status" => "active"],
                    ["title" => "Tomouh", "title_ar" => "طموح", "status" => "active"],
                    ["title" => "Forsah", "title_ar" => "فرصة", "status" => "active"],
                    ["title" => "Jadeer", "title_ar" => "جدير", "status" => "active"],
                    ["title" => "Rafed", "title_ar" => "رفد", "status" => "active"],
                    ["title" => "Ahalina", "title_ar" => "أهالينا", "status" => "active"],
                ],
                "forms" => [
                    [
                        "name" => "Basic Information",
                        "name_ar" => "معلومات أساسية",
                        "type" => "title",
                        "required" => "no",
                        "placeholder" => "",
                        "placeholder_ar" => "",
                        "options" => [],
                        "options_ar" => [],
                        "col" => "12",
                        "status" => "active"
                    ],
                    ["name" => "Organization / Company Name", "name_ar" => "اسم الجهة/المنشأة", "type" => "text", "required" => "yes", "placeholder" => "", "placeholder_ar" => "", "options" => [], "options_ar" => [], "col" => "12", "status" => "active"],
                    ["name" => "Business Sector", "name_ar" => "نوع النشاط", "type" => "text", "required" => "yes", "placeholder" => "", "placeholder_ar" => "", "options" => [], "options_ar" => [], "col" => "12", "status" => "active"],
                    ["name" => "City / Region", "name_ar" => "المدينة / المنطقة", "type" => "text", "required" => "yes", "placeholder" => "", "placeholder_ar" => "", "options" => [], "options_ar" => [], "col" => "12", "status" => "active"],
                    ["name" => "Unified ID / Commercial Registration", "name_ar" => "الرقم الموحد / السجل التجاري", "type" => "text", "required" => "yes", "placeholder" => "", "placeholder_ar" => "", "options" => [], "options_ar" => [], "col" => "12", "status" => "active"],
                    ["name" => "Start Date of Operations", "name_ar" => "تاريخ بداية النشاط", "type" => "date", "required" => "yes", "placeholder" => "", "placeholder_ar" => "", "options" => [], "options_ar" => [], "col" => "12", "status" => "active"],
                    [
                        "name" => "Contact Information",
                        "name_ar" => "معلومات الاتصال",
                        "type" => "title",
                        "required" => "no",
                        "placeholder" => "",
                        "placeholder_ar" => "",
                        "options" => [],
                        "options_ar" => [],
                        "col" => "12",
                        "status" => "active"
                    ],
                    ["name" => "Authorized Person Name", "name_ar" => "اسم الشخص المفوض", "type" => "text", "required" => "yes", "placeholder" => "", "placeholder_ar" => "", "options" => [], "options_ar" => [], "col" => "12", "status" => "active"],
                    ["name" => "Email Address", "name_ar" => "البريد الإلكتروني", "type" => "email", "required" => "yes", "placeholder" => "", "placeholder_ar" => "", "options" => [], "options_ar" => [], "col" => "12", "status" => "active"],
                    ["name" => "Mobile Number", "name_ar" => "رقم الجوال", "type" => "tel", "required" => "yes", "placeholder" => "", "placeholder_ar" => "", "options" => [], "options_ar" => [], "col" => "12", "status" => "active"],
                    ["name" => "Job Title", "name_ar" => "المسمى الوظيفي", "type" => "text", "required" => "yes", "placeholder" => "", "placeholder_ar" => "", "options" => [], "options_ar" => [], "col" => "12", "status" => "active"],
                    [
                        "name" => "Requested Service(s)",
                        "name_ar" => "الخدمة المطلوبة",
                        "type" => "title",
                        "required" => "no",
                        "placeholder" => "",
                        "placeholder_ar" => "",
                        "options" => [],
                        "options_ar" => [],
                        "col" => "12",
                        "status" => "active"
                    ],
                    ["name" => "Requested Program(s)", "name_ar" => "البرنامج المطلوب", "type" => "checkbox", "required" => "yes", "placeholder" => "Select one or more investment programs", "placeholder_ar" => "اختر واحدًا أو أكثر من البرامج الاستثمارية", "options" => [
                        "“Tawteen” Program (Local & Foreign Investment Promotion)",
                        "Export Incentive Program",
                        "Employment Support Programs (Industrial / Tourism)",
                        "\"Made in Saudi\" Program",
                        "Venture Investment Initiative",
                        "Startup Tech Financing",
                        "Incubators & Accelerators Financing",
                        "Credit Facility Program for Enterprises",
                        "E-commerce Support Programs",
                        "Agricultural Support Program (Palm Farmers)",
                        "Jaddah 30",
                        "Tomouh",
                        "Forsah",
                        "Jadeer",
                        "Rafed",
                        "Ahalina"
                    ], "options_ar" => [
                        "برنامج توطين",
                        "برنامج تحفيز الصادرات",
                        "برامج دعم التوظيف (الصناعي/السياحي)",
                        "برنامج صنع في السعودية",
                        "مبادرة الاستثمار الجرئ",
                        "تمويل التقنية الناشئة",
                        "تمويل حاضنات ومسرعات الأعمال",
                        "برنامج التسهيلات الائتمانية للمنشآت",
                        "برامج التجارة الإلكترونية",
                        "برنامج الدعم الزراعي للنخيل والمزارعين",
                        "جادة 30",
                        "طموح",
                        "فرصة",
                        "جدير",
                        "رفد",
                        "أهالينا"
                    ], "col" => "12", "status" => "active"],


                    [
                        "name" => "Brief Description of the Project / Initiative",
                        "name_ar" => "وصف مختصر عن المشروع/المبادرة",
                        "type" => "title",
                        "required" => "no",
                        "placeholder" => "",
                        "placeholder_ar" => "",
                        "options" => [],
                        "options_ar" => [],
                        "col" => "12",
                        "status" => "active"
                    ],

                    ["name" => "Brief Description of the Project / Initiative", "name_ar" => "وصف مختصر عن المشروع/المبادرة", "type" => "textarea", "required" => "no", "placeholder" => "", "placeholder_ar" => "", "options" => [], "options_ar" => [], "col" => "12", "status" => "active"],

                    ["name" => "Attachments (if available)", "name_ar" => "المرفقات (إن وجدت)", "type" => "file", "required" => "no", "placeholder" => "", "placeholder_ar" => "", "options" => ["Project Profile", "Pitch Deck / Presentation", "Letters of Support or Partnership Agreements"], "options_ar" => ["ملف تعريفي للمشروع", "عروض تقديمية", "أي خطابات أو شهادات دعم/شراكة"], "col" => "12", "status" => "active"],

                    ["name" => "Additional Notes", "name_ar" => "ملاحظات إضافية", "type" => "textarea", "required" => "no", "placeholder" => "", "placeholder_ar" => "", "options" => [], "options_ar" => [], "col" => "12", "status" => "active"],
                ],
                "status" => "active",
            ],
        ];



        // first clear all data

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        FinancialInvestment::truncate();
        FinancialInvestmentList::truncate();
        FinancialInvestmentForm::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        // Save to database
        foreach ($financial_investments as $financial_investment) {
            $fi = new FinancialInvestment();

            $fi->title = $financial_investment['title'];
            $fi->title_ar = $financial_investment['title_ar'];
            $fi->status = $financial_investment['status'];
            $fi->save();

            if (isset($financial_investment['lists'])) {
                foreach ($financial_investment['lists'] as $list) {
                    $fi_list = new FinancialInvestmentList();

                    $fi_list->service_id = $fi->id;
                    $fi_list->title = $list['title'];
                    $fi_list->title_ar = $list['title_ar'];
                    $fi_list->status = $list['status'];
                    $fi_list->save();
                }
            }

            if (isset($financial_investment['forms'])) {
                foreach ($financial_investment['forms'] as $form) {
                    $fi_form = new FinancialInvestmentForm();

                    $fi_form->service_id = $fi->id;
                    $fi_form->name = $form['name'];
                    $fi_form->name_ar = $form['name_ar'];
                    $fi_form->type = $form['type'];
                    $fi_form->required = $form['required'];
                    $fi_form->placeholder = $form['placeholder'];
                    $fi_form->placeholder_ar = $form['placeholder_ar'];
                    $fi_form->options = json_encode($form['options']);
                    $fi_form->options_ar = json_encode($form['options_ar']);
                    $fi_form->col = $form['col'];
                    $fi_form->status = $form['status'];
                    $fi_form->save();
                }
            }
        }
    }
}
