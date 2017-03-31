using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Web.Mvc;

namespace Cub.Domian.Entitis
{
    public class Order
    {
        /// <summary>
        /// Индификационный номер заявки
        /// </summary>
        /// 
        [HiddenInput(DisplayValue = false)]
        [Display(Name = "ID")]
        public int Id { get; set; }

        /// <summary>
        /// Индификационный номер недвижимости
        /// </summary>
        /// 
        [HiddenInput(DisplayValue = false)]
        public int? RealEstateId { get; set; }

        /// <summary>
        /// Ссылка на продукт
        /// </summary>
        public RealEstate RealEstate { get; set; }

        /// <summary>
        /// Имя заказчика
        /// </summary>
        [Required(ErrorMessage = "Укажите полное ФИО", AllowEmptyStrings = true)]
        [Display(Name = "Ф.И.О заказчика")]
        public string Name { get; set; }

        /// <summary>
        /// Время подачи заявки
        /// </summary>
        /// 
        [Display(Name = "Время подачи заявки")]
        public DateTime Date { get; set; }

        /// <summary>
        /// Город
        /// </summary>
        [Required(ErrorMessage = "Укажите город", AllowEmptyStrings = true)]
        [Display(Name = "Город")]
        public string City { get; set; }

        /// <summary>
        /// Район
        /// </summary>
        [Required(ErrorMessage = "Укажите район", AllowEmptyStrings = true)]
        [Display(Name = "Район")]
        public string Region { get; set; }

        /// <summary>
        /// Улица
        /// </summary>
        [Required(ErrorMessage = "Укажите улицу", AllowEmptyStrings = true)]
        [Display(Name = "Улица")]
        public string Street { get; set; }

        /// <summary>
        /// Тип помещения
        /// </summary>
        [Required(ErrorMessage = "Укажите тип помещения", AllowEmptyStrings = true)]
        [Display(Name = "Что бы хотели?")]
        [DisplayFormat(NullDisplayText = "Выберети недвижимость")]
        public string TypeOfLodging { get; set; }

        /// <summary>
        /// Стоимость минимальная
        /// </summary>
        /// 
        [Display(Name = "Стоимость минимальная")]
        [Required(ErrorMessage = "Укажите предпологаемый бюджет", AllowEmptyStrings = true)]
        public decimal CostOf { get; set; }

        /// <summary>
        /// Стоимость максимальная
        /// </summary>
        /// 
        [Display(Name = "Стоимость максимальная")]
        [Required(ErrorMessage = "Укажите предпологаемый бюджет", AllowEmptyStrings = true)]
        public decimal CostBegin { get; set; }

        /// <summary>
        /// Дополнительная информация
        /// </summary>
        /// 
        [Display(Name = "Дополнительная информация")]
        [Required(ErrorMessage = "Укажите дополнительную информацию", AllowEmptyStrings = true)]
        public string AdditionalInfo { get; set; }

        /// <summary>
        /// Телефон
        /// </summary>
        /// 
        [Display(Name = "Телефон")]
        [Required(ErrorMessage = "Укажите телефон", AllowEmptyStrings = true)]
        public string Phone { get; set; }

        /// <summary>
        /// E-mail
        /// </summary>
        /// 
        [Display(Name = "E-mail")]
        [Required(ErrorMessage = "Укажите Ваш e-mail", AllowEmptyStrings = true)]
        public string Email { get; set; }

        /// <summary>
        /// Актуальность 
        /// </summary>
        /// 
        [Display(Name = "Актуальность")]
        [Required(ErrorMessage = "Актуальность", AllowEmptyStrings = true)]
        public string Relevance { get; set; }

        /// <summary>
        /// Наши предложения вам
        /// </summary>
        /// 
        [Display(Name = "Наши предложения вам")]
        [Required(ErrorMessage = "Предложения", AllowEmptyStrings = true)]
        public string OurOfferToYou { get; set; }

        /// <summary>
        ///Связаться со мной по телефону
        /// </summary>
        /// 
        [Display(Name = "Связаться со мной по телефону")]
        [Required(ErrorMessage = "Связаться по телефону", AllowEmptyStrings = true)]
        public bool ContactMeByPhone { get; set; }

        /// <summary>
        ///Связаться со мной по E-mail
        /// </summary>
        /// 
        [Display(Name = "Связаться со мной по E-mail")]
        [Required(ErrorMessage = "Связаться по E-mail", AllowEmptyStrings = true)]
        public bool ContactMeByEmail { get; set; }

        /// <summary>
        ///Соглашение
        /// </summary>
        /// 
        [Display(Name = "Соглашение")]
        [Required(ErrorMessage = "Соглашение", AllowEmptyStrings = true)]
        public bool Agreement { get; set; }
    }    
}
