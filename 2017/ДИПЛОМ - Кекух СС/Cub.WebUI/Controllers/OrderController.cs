using Cub.Domian.Abstract;
using Cub.Domian.Concrete;
using Cub.Domian.Entitis;
using Cub.WebUI.Models;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using System.Data;
using System.Data.Entity;


namespace Cub.WebUI.Controllers
{
    public class OrderController : Controller
    {
        /// <summary>
        /// Создание репозитория который хранит данные о недвижимости на основание библаотеки Ninject
        /// </summary>
        public IOrderRepository orderRepo;


        /// <summary>
        /// Конструктор который обладает зависимостью от интерфейса IOrderRepository
        /// </summary>
        /// <param name="repo"></param>
        public OrderController(IOrderRepository repo)
        {
            orderRepo = repo;
        }

        public ViewResult Index()
        {
            return View();
        }
        /// <summary>
        /// Всплывающее модальное окно для отправки заявки на уровне GET озапроса
        /// </summary>
        /// <param name="order">Объект заявки</param>
        /// <returns></returns>
        [HttpGet]

        public ActionResult ModalForm(int item_id)
        {
            Order order = new Order();
            //order.RealEstateId = item_id;

            return View(order);
        }

        /// <summary>
        /// Всплывающее модальное окно на первой странице для отправки заявки на уровне GET озапроса
        /// </summary>
        /// <param name="order">Объект заявки</param>
        /// <returns></returns>

        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult ModalForm(Order order, string typeOfLodging, string value)
        {
            if (ModelState.IsValidField("Name") && ModelState.IsValidField("Phone") && ModelState.IsValidField("Email"))
            {
                order.Relevance = order.Relevance ?? string.Empty;
                order.OurOfferToYou = order.OurOfferToYou ?? string.Empty;
                order.Email = order.Email ?? string.Empty;

                order.Region = order.Region ?? string.Empty;
                order.City = order.City ?? string.Empty;
                order.Street = order.Street ?? string.Empty;

                order.TypeOfLodging = typeOfLodging ?? string.Empty;
                order.AdditionalInfo = value ?? string.Empty;

                orderRepo.SaveOrder(order);
                TempData["message"] = string.Format("Ваша заявка была принята.");
                return PartialView("_PartialDialogOrder");
            }

            return PartialView(order);
        }


    }
}