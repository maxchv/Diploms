using Cub.Domian.Abstract;
using Cub.Domian.Entitis;
using System;
using System.Collections.Generic;
using System.Data.SqlTypes;
using System.Linq;
using System.Web;
using System.Web.Mvc;

namespace Cub.WebUI.Controllers
{
    public class OrderClientController : Controller
    {
        /// <summary>
        /// Создание репозитория который хранит данные о недвижимости на основание библаотеки Ninject
        /// </summary>
        public IOrderСlientRepository orderRepo;


        /// <summary>
        /// Конструктор который обладает зависимостью от интерфейса IOrderRepository
        /// </summary>
        /// <param name="repo"></param>
        public OrderClientController(IOrderСlientRepository repo)
        {
            orderRepo = repo;
        }


        public ViewResult Index()
        {
            return View();
        }
        /// <summary>
        /// Всплывающее модальное окно на первой странице для отправки заявки на уровне GET озапроса
        /// </summary>
        /// <param name="order">Объект заявки</param>
        /// <returns></returns>

        public ActionResult ModalFormOnePage(/*string item_message*/)
        {
            //ViewBag.Message = item_message;
            return View();
        }

        /// <summary>
        /// Всплывающее модальное окно на первой странице для отправки заявки на уровне GET озапроса
        /// </summary>
        /// <param name="order">Объект заявки</param>
        /// <returns></returns>

        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult ModalFormOnePage(OrderClient order, string typeOfLodging, string value, string operationReal)
        {
            if (ModelState.IsValidField("Name") && ModelState.IsValidField("Phone") && ModelState.IsValidField("Email"))
            {
                    order.Relevance = order.Relevance ?? string.Empty;
                    order.OurOfferToYou = order.OurOfferToYou ?? string.Empty;
                    order.Email = order.Email ?? string.Empty;

                    order.Region = order.Region ?? string.Empty;
                    order.City = order.City ?? string.Empty;
                    order.Street = order.Street ?? string.Empty;


                    order.AdditionalInfo = value ?? string.Empty;
                    orderRepo.SaveOrder(order);
                    //TempData["message"] = string.Format("Ваша заявка была принята.");
                    return PartialView("_PartialDialog");
            }            
            return PartialView(order);
        }
    }
}