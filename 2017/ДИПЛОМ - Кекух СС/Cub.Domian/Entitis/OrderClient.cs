using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Web.Mvc;

namespace Cub.Domian.Entitis
{
    public class OrderClient
    {
        /// <summary>
        /// Индификационный номер заявки
        /// </summary>
        /// 
        [HiddenInput(DisplayValue = false)]
        [Display(Name = "ID")]
        public int Id { get; set; }

        /// <summary>
        /// Имя заказчика
        /// </summary>
        /// 

        [Display(Name = "Ф.И.О.")]
        [Required(ErrorMessage = "Укажите полное ФИО")]
        public string Name { get; set; }

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
        /// Время подачи заявки
        /// </summary>
        /// 

        public DateTime Date { get; set; }

        /// <summary>
        /// Город
        /// </summary>
        /// 
        [Display(Name = "Город")]
        //[Required(ErrorMessage = "Укажите город", AllowEmptyStrings = true)]
        public string City { get; set; }

        /// <summary>
        /// Район
        /// </summary>
        /// 
        [Display(Name = "Район")]
        //[Required(ErrorMessage = "Укажите район", AllowEmptyStrings = true)]
        public string Region { get; set; }

        /// <summary>
        /// Улица
        /// </summary>
        /// 
        [Display(Name = "Улица")]
        //[Required(ErrorMessage = "Укажите улицу", AllowEmptyStrings = true)]
        public string Street { get; set; }

        /// <summary>
        /// Тип помещения
        /// </summary>
        //[Required(ErrorMessage = "Укажите тип помещения", AllowEmptyStrings = true)]
        [Display(Name = "Тип недвижимотси")]
        [DisplayFormat(NullDisplayText = "Выберети недвижимость")]
        public string TypeOfLodging { get; set; }

        /// <summary>
        /// Стоимость
        /// </summary>
        /// 
        [Display(Name = "Минимальная стоимость ")]
        //[Required(ErrorMessage = "Укажите предпологаемый бюджет", AllowEmptyStrings = true)]
        public decimal CostOf { get; set; }

        /// <summary>
        /// Стоимость
        /// </summary>
        /// 
        [Display(Name = "Максимальная стоимость")]
        //[Required(ErrorMessage = "Укажите предпологаемый бюджет", AllowEmptyStrings = true)]
        public decimal CostBegin { get; set; }

        /// <summary>
        /// Дополнительная информация
        /// </summary>
        /// 
        [Display(Name = "Дополнительная информация")]
        //[Required(ErrorMessage = "Укажите дополнительную информацию", AllowEmptyStrings = true)]
        public string AdditionalInfo { get; set; }
        
        /// <summary>
        /// Актуальность 
        /// </summary>
        /// 
        [Display(Name = "Актуальность")]
        //[Required(ErrorMessage = "Актуальность", AllowEmptyStrings = true)]
        public string Relevance { get; set; }

        /// <summary>
        /// Наши предложения вам
        /// </summary>
        /// 
        [Display(Name = "Наши предложения вам")]
        //[Required(ErrorMessage = "Наши предложения вам", AllowEmptyStrings = true)]
        public string OurOfferToYou { get; set; }

        /// <summary>
        ///Связаться со мной по телефону
        /// </summary>
        /// 
        [Display(Name = "Связаться со мной по телефону")]
        public bool ContactMeByPhone { get; set; }

        /// <summary>
        ///Связаться со мной по E-mail
        /// </summary>
        /// 
        [Display(Name = "Связаться со мной по E-mail")]
        public bool ContactMeByEmail { get; set; }

        /// <summary>
        ///Соглашение
        /// </summary>
        /// 
        [Display(Name = "Соглашение")]
        public bool Agreement { get; set; }
        /// <summary>
        /// Продам Сдам Сдам посуточно Куплю Сниму Продам
        /// </summary>
        /// 
        [Display(Name = "Услуги")]
        //[Required(ErrorMessage = "Услуги", AllowEmptyStrings = true)]
        public string OperationReal { get; set; }
    }
}
