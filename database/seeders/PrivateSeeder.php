<?php

namespace Database\Seeders;

use App\Models\PrivateSector;
use Illuminate\Database\Seeder;
use App\Models\PrivateSectorForm;
use App\Models\PrivateSectorList;
use Illuminate\Support\Facades\DB;

class PrivateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $private_sectors = [
            [
                "title" => "Individual Financing Services",
                "title_ar" => "خدمات التمويل للأفراد",
                "lists" => [
                    [
                        "title" => "Personal Financing",
                        "title_ar" => "التمويل الشخصي",
                        "status" => "active",
                    ],
                    [
                        "title" => "Consumer Financing",
                        "title_ar" => "التمويل الاستهلاكي",
                        "status" => "active",
                    ],
                    [
                        "title" => "Auto Financing",
                        "title_ar" => "تمويل السيارات",
                        "status" => "active",
                    ],
                    [
                        "title" => "Mortgage Financing",
                        "title_ar" => "التمويل العقاري",
                        "status" => "active",
                    ],
                    [
                        "title" => "Educational Financing",
                        "title_ar" => "التمويل التعليمي",
                        "status" => "active",
                    ],
                    [
                        "title" => "Medical Financing",
                        "title_ar" => "التمويل الطبي",
                        "status" => "active",
                    ],
                    [
                        "title" => "Travel and Tourism Financing",
                        "title_ar" => "تمويل السفر والسياحة",
                        "status" => "active",
                    ],
                    [
                        "title" => "Micro Financing",
                        "title_ar" => "التمويل متناهي الصغر",
                        "status" => "active",
                    ],
                    [
                        "title" => "Financing via Digital Wallets and Applications",
                        "title_ar" => "التمويل عبر التطبيقات والمحافظ الرقمية",
                        "status" => "active",
                    ],
                ],
            ],
            [
                "title" => "SME Financing Services",
                "title_ar" => "خدمات التمويل للمنشآت الصغيرة والمتوسطة (SMEs)",
                "lists" => [
                    [
                        "title" => "Startup Project Financing",
                        "title_ar" => "تمويل تأسيس المشاريع",
                        "status" => "active",
                    ],
                    [
                        "title" => "Working Capital Financing",
                        "title_ar" => "تمويل رأس المال العامل",
                        "status" => "active",
                    ],
                    [
                        "title" => "Expansion and Development Financing",
                        "title_ar" => "تمويل التوسع والتطوير",
                        "status" => "active",
                    ],
                    [
                        "title" => "Equipment and Asset Financing",
                        "title_ar" => "تمويل شراء المعدات والأصول",
                        "status" => "active",
                    ],
                    [
                        "title" => "Supply Chain Financing (Suppliers & Distributors)",
                        "title_ar" => "تمويل سلسلة الإمداد (الموردين والموزعين)",
                        "status" => "active",
                    ],
                    [
                        "title" => "Invoice Financing (Accounts Receivable Financing)",
                        "title_ar" => "تمويل الفواتير (التمويل مقابل الذمم المدينة)",
                        "status" => "active",
                    ],
                    [
                        "title" => "Micro Financing for Emerging Enterprises",
                        "title_ar" => "التمويل متناهي الصغر للمنشآت الناشئة",
                        "status" => "active",
                    ],
                    [
                        "title" => "Export Financing",
                        "title_ar" => "تمويل الصادرات",
                        "status" => "active",
                    ],
                    [
                        "title" => "Bank Guarantees and Complementary Financing",
                        "title_ar" => "الضمانات البنكية والتمويل المكمل",
                        "status" => "active",
                    ],
                    [
                        "title" => "Crowdfunding Platform Financing",
                        "title_ar" => "التمويل عبر منصات التمويل الجماعي",
                        "status" => "active",
                    ],
                ],
            ],
            [
                "title" => "Corporate Financing Services",
                "title_ar" => "خدمات تمويل الشركات الكبرى",
                "lists" => [
                    [
                        "title" => "Major Project Financing",
                        "title_ar" => "تمويل المشاريع الكبرى",
                        "status" => "active",
                    ],
                    [
                        "title" => "Long-Term Capital Financing",
                        "title_ar" => "تمويل رأس المال طويل الأجل",
                        "status" => "active",
                    ],
                    [
                        "title" => "Mergers & Acquisitions (M&A) Financing",
                        "title_ar" => "تمويل الاستحواذ والاندماج",
                        "status" => "active",
                    ],
                    [
                        "title" => "Structured Finance",
                        "title_ar" => "التمويل الهيكلي",
                        "status" => "active",
                    ],
                    [
                        "title" => "Commercial Real Estate Financing",
                        "title_ar" => "التمويل العقاري التجاري",
                        "status" => "active",
                    ],
                    [
                        "title" => "Export & Import Financing (International Trade)",
                        "title_ar" => "تمويل الصادرات والواردات (التجارة الدولية)",
                        "status" => "active",
                    ],
                    [
                        "title" => "Heavy Equipment and Asset Financing",
                        "title_ar" => "تمويل الأصول والمعدات الثقيلة",
                        "status" => "active",
                    ],
                    [
                        "title" => "Sukuk and Bonds Financing",
                        "title_ar" => "التمويل عبر الصكوك والسندات",
                        "status" => "active",
                    ],
                    [
                        "title" => "Digital Transformation and Infrastructure Financing",
                        "title_ar" => "تمويل التحول الرقمي والبنية التحتية",
                        "status" => "active",
                    ],
                    [
                        "title" => "Credit Facilities (Lines of Credit – Revolving Loans)",
                        "title_ar" => "التسهيلات الائتمانية (خطوط ائتمان – قروض دوّارة)",
                        "status" => "active",
                    ],
                    [
                        "title" => "Islamic Financing (Murabaha, Ijara, Istisna’a, etc.)",
                        "title_ar" => "التمويل الإسلامي (مرابحة، إجارة، استصناع...)",
                        "status" => "active",
                    ],
                    [
                        "title" => "Investment Banking Services",
                        "title_ar" => "الخدمات المصرفية الاستثمارية",
                        "status" => "active",
                    ],
                ],
            ],
        ];
        
        $forms = [
            [
                'name' => 'Applicant Information',
                'name_ar' => 'معلومات مقدم الطلب',
                'type' => 'title',
                'required' => 'no',
                'placeholder' => '',
                'placeholder_ar' => '',
                'options' => [],
                'options_ar' => [],
                'col' => '12',
                'status' => 'active',
                'conditional_on' => null,
                'conditional_value' => [],
            ],

            [
                'name' => 'Type',
                'name_ar' => 'النوع',
                'type' => 'radio',
                'required' => 'yes',
                'placeholder' => '',
                'placeholder_ar' => '',
                'options' => ['Individual', 'SME', 'Corporate'],
                'options_ar' => ['فرد', 'منشأة صغيرة/متوسطة', 'شركة كبرى'],
                'col' => '12',
                'status' => 'active',
                'conditional_on' => null,
                'conditional_value' => [],
                'display' => 'form-check-inline',
            ],
            // Conditional Fields for Individuals
            [
                'name' => 'Full Name',
                'name_ar' => 'الاسم الكامل',
                'type' => 'text',
                'required' => 'yes',
                'placeholder' => 'Enter Full Name',
                'placeholder_ar' => 'أدخل الاسم الكامل',
                'options' => [],
                'options_ar' => [],
                'col' => '12',
                'status' => 'active',
                'conditional_on' => 'Type',
                'conditional_value' => 'Individual',
            ],
            [
                'name' => 'National ID Number',
                'name_ar' => 'رقم الهوية الوطنية',
                'type' => 'text',
                'required' => 'yes',
                'placeholder' => 'e.g., 10XXXXXXX',
                'placeholder_ar' => 'مثال: 10XXXXXXX',
                'options' => [],
                'options_ar' => [],
                'col' => '6',
                'status' => 'active',
                'conditional_on' => 'Type',
                'conditional_value' => 'Individual',
            ],
            [
                'name' => 'Date of Birth',
                'name_ar' => 'تاريخ الميلاد',
                'type' => 'date',
                'required' => 'yes',
                'placeholder' => 'YYYY-MM-DD',
                'placeholder_ar' => 'سنة-شهر-يوم',
                'options' => [],
                'options_ar' => [],
                'col' => '6',
                'status' => 'active',
                'conditional_on' => 'Type',
                'conditional_value' => 'Individual',
            ],
            [
                'name' => 'Marital Status',
                'name_ar' => 'الحالة الاجتماعية',
                'type' => 'select',
                'required' => 'yes',
                'placeholder' => 'Select Status',
                'placeholder_ar' => 'اختر الحالة',
                'options' => ['Single', 'Married', 'Divorced', 'Widowed'],
                'options_ar' => ['أعزب', 'متزوج', 'مطلق', 'أرمل'],
                'col' => '6',
                'status' => 'active',
                'conditional_on' => 'Type',
                'conditional_value' => 'Individual',
            ],
            [
                'name' => 'City / Region',
                'name_ar' => 'المدينة / المنطقة',
                'type' => 'text',
                'required' => 'yes',
                'placeholder' => 'e.g., Riyadh',
                'placeholder_ar' => 'مثال: الرياض',
                'options' => [],
                'options_ar' => [],
                'col' => '6',
                'status' => 'active',
                'conditional_on' => 'Type',
                'conditional_value' => 'Individual',
            ],
            [
                'name' => 'Mobile Number',
                'name_ar' => 'رقم الجوال',
                'type' => 'text',
                'required' => 'yes',
                'placeholder' => 'e.g., 05XXXXXXXX',
                'placeholder_ar' => 'مثال: 05XXXXXXXX',
                'options' => [],
                'options_ar' => [],
                'col' => '6',
                'status' => 'active',
                'conditional_on' => 'Type',
                'conditional_value' => 'Individual',
            ],
            [
                'name' => 'Email Address',
                'name_ar' => 'البريد الإلكتروني',
                'type' => 'email',
                'required' => 'yes',
                'placeholder' => 'name@example.com',
                'placeholder_ar' => 'name@example.com',
                'options' => [],
                'options_ar' => [],
                'col' => '6',
                'status' => 'active',
                'conditional_on' => 'Type',
                'conditional_value' => 'Individual',
            ],
            [
                'name' => 'Current Occupation',
                'name_ar' => 'نوع العمل الحالي',
                'type' => 'text',
                'required' => 'yes',
                'placeholder' => 'e.g., Engineer, Teacher, etc.',
                'placeholder_ar' => 'مثال: مهندس، مدرس، إلخ',
                'options' => [],
                'options_ar' => [],
                'col' => '6',
                'status' => 'active',
                'conditional_on' => 'Type',
                'conditional_value' => 'Individual',
            ],
            [
                'name' => 'Average Monthly Income',
                'name_ar' => 'متوسط الدخل الشهري',
                'type' => 'number',
                'required' => 'yes',
                'placeholder' => 'Amount in SAR',
                'placeholder_ar' => 'المبلغ بالريال السعودي',
                'options' => [],
                'options_ar' => [],
                'col' => '6',
                'status' => 'active',
                'conditional_on' => 'Type',
                'conditional_value' => 'Individual',
            ],
            // Conditional Fields for Enterprises / Corporates
            [
                'name' => 'Company / Entity Name',
                'name_ar' => 'اسم المنشأة / الشركة',
                'type' => 'text',
                'required' => 'yes',
                'placeholder' => 'Enter Official Name',
                'placeholder_ar' => 'أدخل الاسم الرسمي',
                'options' => [],
                'options_ar' => [],
                'col' => '12',
                'status' => 'active',
                'conditional_on' => 'Type',
                'conditional_value' => ['SME', 'Corporate'],
            ],
            [
                'name' => 'Commercial Registration Number',
                'name_ar' => 'رقم السجل التجاري',
                'type' => 'text',
                'required' => 'yes',
                'placeholder' => 'e.g., 1010XXXXXX',
                'placeholder_ar' => 'مثال: 1010XXXXXX',
                'options' => [],
                'options_ar' => [],
                'col' => '6',
                'status' => 'active',
                'conditional_on' => 'Type',
                'conditional_value' => ['SME', 'Corporate'],
            ],
            [
                'name' => 'Type of Business Activity',
                'name_ar' => 'نوع النشاط',
                'type' => 'text',
                'required' => 'yes',
                'placeholder' => 'e.g., Retail, Construction, IT',
                'placeholder_ar' => 'مثال: تجارة التجزئة، المقاولات، تقنية المعلومات',
                'options' => [],
                'options_ar' => [],
                'col' => '6',
                'status' => 'active',
                'conditional_on' => 'Type',
                'conditional_value' => ['SME', 'Corporate'],
            ],
            [
                'name' => 'Establishment Date',
                'name_ar' => 'تاريخ التأسيس',
                'type' => 'date',
                'required' => 'yes',
                'placeholder' => 'YYYY-MM-DD',
                'placeholder_ar' => 'سنة-شهر-يوم',
                'options' => [],
                'options_ar' => [],
                'col' => '6',
                'status' => 'active',
                'conditional_on' => 'Type',
                'conditional_value' => ['SME', 'Corporate'],
            ],
            [
                'name' => 'City / Region',
                'name_ar' => 'المدينة / المنطقة',
                'type' => 'text',
                'required' => 'yes',
                'placeholder' => 'e.g., Jeddah',
                'placeholder_ar' => 'مثال: جدة',
                'options' => [],
                'options_ar' => [],
                'col' => '6',
                'status' => 'active',
                'conditional_on' => 'Type',
                'conditional_value' => ['SME', 'Corporate'],
            ],
            [
                'name' => 'Number of Employees',
                'name_ar' => 'عدد الموظفين',
                'type' => 'number',
                'required' => 'yes',
                'placeholder' => 'e.g., 15',
                'placeholder_ar' => 'مثال: 15',
                'options' => [],
                'options_ar' => [],
                'col' => '6',
                'status' => 'active',
                'conditional_on' => 'Type',
                'conditional_value' => ['SME', 'Corporate'],
            ],
            [
                'name' => 'Annual Revenue',
                'name_ar' => 'الإيرادات السنوية',
                'type' => 'number',
                'required' => 'yes',
                'placeholder' => 'Amount in SAR',
                'placeholder_ar' => 'المبلغ بالريال السعودي',
                'options' => [],
                'options_ar' => [],
                'col' => '6',
                'status' => 'active',
                'conditional_on' => 'Type',
                'conditional_value' => ['SME', 'Corporate'],
            ],
            [
                'name' => 'Representative Name',
                'name_ar' => 'اسم ممثل الجهة',
                'type' => 'text',
                'required' => 'yes',
                'placeholder' => 'Full Name of Representative',
                'placeholder_ar' => 'الاسم الكامل للممثل',
                'options' => [],
                'options_ar' => [],
                'col' => '6',
                'status' => 'active',
                'conditional_on' => 'Type',
                'conditional_value' => ['SME', 'Corporate'],
            ],
            [
                'name' => 'Mobile Number',
                'name_ar' => 'رقم الجوال',
                'type' => 'text',
                'required' => 'yes',
                'placeholder' => 'e.g., 05XXXXXXXX',
                'placeholder_ar' => 'مثال: 05XXXXXXXX',
                'options' => [],
                'options_ar' => [],
                'col' => '6',
                'status' => 'active',
                'conditional_on' => 'Type',
                'conditional_value' => ['SME', 'Corporate'],
            ],
            [
                'name' => 'Email Address',
                'name_ar' => 'البريد الإلكتروني',
                'type' => 'email',
                'required' => 'yes',
                'placeholder' => 'name@company.com',
                'placeholder_ar' => 'name@company.com',
                'options' => [],
                'options_ar' => [],
                'col' => '6',
                'status' => 'active',
                'conditional_on' => 'Type',
                'conditional_value' => ['SME', 'Corporate'],
            ],
            [
                'name' => 'Type of Requested Service',
                'name_ar' => 'نوع الخدمة المطلوبة',
                'type' => 'title',
                'required' => 'no',
                'placeholder' => '',
                'placeholder_ar' => '',
                'options' => [],
                'options_ar' => [],
                'col' => '12',
                'status' => 'active',
                'conditional_on' => null,
                'conditional_value' => [],
            ],
            [
                'name' => 'Service Type',
                'name_ar' => 'نوع الخدمة التمويلية',
                'type' => 'checkbox',
                'required' => 'yes',
                'placeholder' => 'Please select one or more',
                'placeholder_ar' => 'يرجى اختيار واحد أو أكثر',
                'options' => [
                    'Personal Financing',
                    'Consumer Financing',
                    'Mortgage Financing',
                    'Auto Financing',
                    'Medical Financing',
                    'Educational Financing',
                    'Startup Project Financing',
                    'Equipment and Asset Financing',
                    'Working Capital Financing',
                    'Strategic Financing (Corporate)',
                    'Financing Guarantee',
                    'Advisory Services',
                    'Other'
                ],
                'options_ar' => [
                    'تمويل شخصي',
                    'تمويل استهلاكي',
                    'تمويل عقاري',
                    'تمويل سيارات',
                    'تمويل طبي',
                    'تمويل تعليمي',
                    'تمويل مشروع ناشئ',
                    'تمويل معدات وأصول',
                    'تمويل رأس مال عامل',
                    'تمويل استراتيجي (شركات كبرى)',
                    'ضمان تمويلي',
                    'خدمات استشارية',
                    'أخرى'
                ],
                'col' => '12',
                'status' => 'active',
                'conditional_on' => null,
                'conditional_value' => [],
            ],
            [
                'name' => 'Other Service Type',
                'name_ar' => 'نوع آخر',
                'type' => 'text',
                'required' => 'no',
                'placeholder' => 'Please specify',
                'placeholder_ar' => 'يرجى التحديد',
                'options' => [],
                'options_ar' => [],
                'col' => '12',
                'status' => 'active',
                'conditional_on' => 'Service Type',
                'conditional_value' => 'Other',
            ],
            [
                'name' => 'Service or Project Details',
                'name_ar' => 'تفاصيل الخدمة أو المشروع',
                'type' => 'title',
                'required' => 'no',
                'placeholder' => '',
                'placeholder_ar' => '',
                'options' => [],
                'options_ar' => [],
                'col' => '12',
                'status' => 'active',
                'conditional_on' => null,
                'conditional_value' => [],
            ],
            [
                'name' => 'Project Description',
                'name_ar' => 'وصف مختصر للهدف',
                'type' => 'textarea',
                'required' => 'yes',
                'placeholder' => 'Briefly describe the purpose of the financing...',
                'placeholder_ar' => 'اشرح بإيجاز الهدف من التمويل...',
                'options' => [],
                'options_ar' => [],
                'col' => '12',
                'status' => 'active',
                'conditional_on' => null,
                'conditional_value' => [],
            ],
            [
                'name' => 'Requested Financing Amount',
                'name_ar' => 'قيمة التمويل المطلوبة',
                'type' => 'number',
                'required' => 'yes',
                'placeholder' => 'Amount in SAR',
                'placeholder_ar' => 'المبلغ بالريال السعودي',
                'options' => [],
                'options_ar' => [],
                'col' => '6',
                'status' => 'active',
                'conditional_on' => null,
                'conditional_value' => [],
            ],
            [
                'name' => 'Applicant\'s Contribution',
                'name_ar' => 'نسبة مساهمة مقدم الطلب',
                'type' => 'number',
                'required' => 'no',
                'placeholder' => 'Amount in SAR (if any)',
                'placeholder_ar' => 'المبلغ بالريال (إن وجدت)',
                'options' => [],
                'options_ar' => [],
                'col' => '6',
                'status' => 'active',
                'conditional_on' => null,
                'conditional_value' => [],
            ],
            [
                'name' => 'Desired Financing Term',
                'name_ar' => 'مدة التمويل المطلوبة',
                'type' => 'radio',
                'required' => 'yes',
                'placeholder' => '',
                'placeholder_ar' => '',
                'options' => ['1 year', '2 years', '3 years or more'],
                'options_ar' => ['سنة', 'سنتان', '3 سنوات أو أكثر'],
                'col' => '12',
                'status' => 'active',
                'conditional_on' => null,
                'conditional_value' => [],
            ],
            [
                'name' => 'Feasibility Study',
                'name_ar' => 'دراسة جدوى / خطة عمل',
                'type' => 'radio',
                'required' => 'yes',
                'placeholder' => '',
                'placeholder_ar' => '',
                'options' => ['Yes', 'No'],
                'options_ar' => ['نعم', 'لا'],
                'col' => '6',
                'status' => 'active',
                'conditional_on' => null,
                'conditional_value' => [],
            ],
            [
                'name' => 'Feasibility Study File',
                'name_ar' => 'ملف دراسة الجدوى',
                'type' => 'file',
                'required' => 'no',
                'placeholder' => 'Attach PDF, DOC, etc.',
                'placeholder_ar' => 'أرفق PDF, DOC, إلخ',
                'options' => [],
                'options_ar' => [],
                'col' => '6',
                'status' => 'active',
                'conditional_on' => 'Feasibility Study',
                'conditional_value' => 'Yes',
            ],
            [
                'name' => 'Required Documents',
                'name_ar' => 'المستندات المطلوبة',
                'type' => 'title',
                'required' => 'no',
                'placeholder' => '',
                'placeholder_ar' => '',
                'options' => [],
                'options_ar' => [],
                'col' => '12',
                'status' => 'active',
                'conditional_on' => null,
                'conditional_value' => [],
            ],
            [
                'name' => 'Attached Documents',
                'name_ar' => 'المستندات المرفقة',
                'type' => 'checkbox',
                'required' => 'yes',
                'placeholder' => 'Please check what you are attaching',
                'placeholder_ar' => 'يرجى تحديد ما سيتم إرفاقه',
                'options' => [
                    'National ID / Commercial Registration',
                    'National Address Certificate',
                    'Bank Statement for the Last 3 Months',
                    'Feasibility Study / Business Plan',
                    'Any Relevant Licenses or Permits'
                ],
                'options_ar' => [
                    'الهوية الوطنية / السجل التجاري',
                    'العنوان الوطني',
                    'كشف حساب بنكي لآخر 3 أشهر',
                    'دراسة جدوى / خطة عمل',
                    'أي تراخيص أو وثائق إضافية'
                ],
                'col' => '12',
                'status' => 'active',
                'conditional_on' => null,
                'conditional_value' => [],
            ],
            [
                'name' => 'Document Upload',
                'name_ar' => 'رفع المستندات',
                'type' => 'file',
                'required' => 'yes',
                'placeholder' => 'Upload all files in ZIP or individually',
                'placeholder_ar' => 'ارفع جميع الملفات في ZIP أو بشكل فردي',
                'options' => [],
                'options_ar' => [],
                'col' => '12',
                'status' => 'active',
                'conditional_on' => null,
                'conditional_value' => [],
            ],
            [
                'name' => 'Terms and Conditions Agreement',
                'name_ar' => 'الموافقة على الشروط',
                'type' => 'title',
                'required' => 'no',
                'placeholder' => '',
                'placeholder_ar' => '',
                'options' => [],
                'options_ar' => [],
                'col' => '12',
                'status' => 'active',
                'conditional_on' => null,
                'conditional_value' => [],
            ],
            [
                'name' => 'Agreement 1',
                'name_ar' => 'الإقرار بصحة المعلومات',
                'type' => 'checkbox',
                'required' => 'yes',
                'placeholder' => 'I hereby confirm the accuracy of the provided information and documents.',
                'placeholder_ar' => 'أقرّ بصحة المعلومات والمستندات المقدّمة.',
                'options' => [
                    "I hereby confirm the accuracy of the provided information and documents."
                ],
                'options_ar' => [
                    'أقرّ بصحة المعلومات والمستندات المقدّمة.',
                ],
                'col' => '12',
                'status' => 'active',
                'conditional_on' => null,
                'conditional_value' => [],
            ],
            [
                'name' => 'Agreement 2',
                'name_ar' => 'موافقة مشاركة البيانات',
                'type' => 'checkbox',
                'required' => 'yes',
                'placeholder' => 'I agree to share my data with relevant financing entities.',
                'placeholder_ar' => 'أوافق على مشاركة بياناتي مع الجهات التمويلية ذات العلاقة.',
                'options' => [
                    "I agree to share my data with relevant financing entities."
                ],
                'options_ar' => [
                    'أوافق على مشاركة بياناتي مع الجهات التمويلية ذات العلاقة.',
                ],
                'col' => '12',
                'status' => 'active',
                'conditional_on' => null,
                'conditional_value' => [],
            ],
            [
                'name' => 'Agreement 3',
                'name_ar' => 'موافقة الاستلام',
                'type' => 'checkbox',
                'required' => 'no',
                'placeholder' => 'I consent to receive notifications via email or mobile.',
                'placeholder_ar' => 'أوافق على استقبال إشعارات عبر البريد الإلكتروني أو الجوال.',
                'options' => [
                    "I consent to receive notifications via email or mobile."
                ],
                'options_ar' => [
                    'أوافق على استقبال إشعارات عبر البريد الإلكتروني أو الجوال.',
                ],
                'col' => '12',
                'status' => 'active',
                'conditional_on' => null,
                'conditional_value' => [],
            ],
        ];




         // first clear all data
         DB::statement('SET FOREIGN_KEY_CHECKS=0;');
         PrivateSector::truncate();
         PrivateSectorList::truncate();
         PrivateSectorForm::truncate();
 
         DB::statement('SET FOREIGN_KEY_CHECKS=1;');
 
 
         
         // Save to database
         foreach ($private_sectors as $private_sector) {
             $os = new PrivateSector();
         
             $os->title = $private_sector['title'];
             $os->title_ar = $private_sector['title_ar'];
             $os->status = 'active';
             $os->save();
         
             if (isset($private_sector['lists'])) {
                 foreach ($private_sector['lists'] as $list) {
                     $oslist = new PrivateSectorList();
         
                     $oslist->service_id = $os->id;
                     $oslist->title = $list['title'];
                     $oslist->title_ar = $list['title_ar'];
                     $oslist->status = $list['status'];
                     $oslist->save();
                 }
             }
         
             if (isset($forms)) {
                 foreach ($forms as $form) {
                     $osform = new PrivateSectorForm();
        
                     $osform->service_id = $os->id;
                     $osform->name = $form['name'];
                     $osform->name_ar = $form['name_ar'];
                     $osform->type = $form['type'];
                     $osform->required = $form['required'];
                     $osform->placeholder = $form['placeholder'];
                     $osform->placeholder_ar = $form['placeholder_ar'];
                     $osform->options = isset($form['options']) ? json_encode($form['options']) : [];
                     $osform->options_ar = isset($form['options_ar']) ? json_encode($form['options_ar']) : [];
                     $osform->col = $form['col'];
                     $osform->conditional_on = isset($form['conditional_on']) ? $form['conditional_on'] : null;
                     $osform->conditional_value = isset($form['conditional_value']) ? json_encode($form['conditional_value']) : [];
                     $osform->display = isset($form['display']) ? $form['display'] : 'form-check-block';
                     $osform->status = $form['status'];
                     $osform->save();
                 }
             }
         }
    }
}
