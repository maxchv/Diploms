using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Cub.Domian.Entitis
{
    public class RealEstate
    {
        /// <summary>
        /// Номер недвижимости
        /// </summary>
        ///
        [Display(Name = "ID")]
        public int Id {get;set;}
        /// <summary>
        /// Тип
        /// </summary>
        /// 
        [Display(Name = "Тип недвижимости")]
        public string Type { get;set;}
        /// <summary>
        /// Категория
        /// </summary>
        /// 
        [Display(Name = "Категория")]
        public string Category { get;set;}
        /// <summary>
        /// Населённый пунк / Район
        /// </summary>
        /// 
        [Display(Name = "Населённый пунк")]
        public string InhabitedLocalityAndDistrict {get;set;}

        /// <summary>
        /// Город
        /// </summary>
        /// 
        [Display(Name = "Город")]
        public string Citi { get; set; }
        /// <summary>
        /// Комнат
        /// </summary>
        /// 
        [Display(Name = "Количество комнат")]
        public int Rooms { get;set;}
        /// <summary>
        /// Соток
        /// </summary>
        /// 
        [Display(Name = "Площадь земли")]
        public double HundredPart {get;set;}
        /// <summary>
        /// Площадь
        /// </summary>
        /// 
        [Display(Name = "Площадь недвижимости")]
        public double Square { get;set;}
        /// <summary>
        /// Дополнительно
        /// </summary>
        /// 
        [Display(Name = "Дополнительная информация")]
        public string Additionally { get;set;}
        /// <summary>
        /// Бюджет
        /// </summary>
        /// 
        [Display(Name = "Бюджет")]
        public decimal Budget { get;set;}
        /// <summary>
        /// Телефон
        /// </summary>
        /// 
        [Display(Name = "Телефон")]
        public string PhoneNumber {get;set;}
        /// <summary>
        /// Дата
        /// </summary>
        /// 
        [Display(Name = "Дата добавления недвижимости")]
        public DateTime Date { get; set; }
        /// <summary>
        /// Метка
        /// </summary>
        /// 
        [Display(Name = "Метка")]
        public string Tags { get; set; }
        /// <summary>
        /// Инфо
        /// </summary>
        /// 
        [Display(Name = "Информация о невижимости")]
        public string Info { get; set; }
        /// <summary>
        /// Продам Сдам Сдам посуточно Куплю Сниму Продам
        /// </summary>
        /// 
        [Display(Name = "Услуги")]
        public string TypeOfOperations { get; set; }
        /// <summary>
        /// Набор заказов выполняется для связи между таблиами
        /// </summary>
        public List<Order> Orders { get; set; }

        /// <summary>
        /// Первая картинка
        /// </summary>
        ///       
        [Display(Name = "Первая картинка")]
        public byte[] imgOne { get; set; }
        /// <summary>
        /// Вторая картинка
        /// </summary>
        ///         
        [Display(Name = "Вторая картинка")]
        public byte[] imgTwo { get; set; }
        /// <summary>
        /// Третья картинка
        /// </summary>
        ///      
        [Display(Name = "Третья картинка")]
        public byte[] imgThree { get; set; }
        /// <summary>
        /// Четвертая картинка
        /// </summary>
        ///         
        [Display(Name = "Четвертая картинка")]
        public byte[] imgFhore { get; set; }
        /// <summary>
        /// Пятая картинка
        /// </summary>
        ///      
        [Display(Name = "Пятая картинка")]
        public byte[] imgFive { get; set; }
    }
}
