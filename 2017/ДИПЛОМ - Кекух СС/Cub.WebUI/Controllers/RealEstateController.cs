using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using Cub.Domian.Abstract;
using Cub.Domian.Entitis;
using Cub.WebUI.Models;

namespace Cub.WebUI.Controllers
{
    public class RealEstateController : Controller
    {
        public static string TypeOp { get; set; }//Тип недвижимотси

        public static int RoomType { get; set; }

        /// <summary>
        /// Создание репозитория который хранит данные о недвижимости на основание библаотеки Ninject
        /// </summary>
        public IRealEstateRepository repository;



        /// <summary>
        /// Количество объектов отображаемых на странице 
        /// </summary>
        public int pageSize = 8;

        /// <summary>
        /// Конструктор который обладает зависимостью от интерфейса IRealEstateRepository
        /// </summary>
        /// <param name="repo"></param>
        public RealEstateController(IRealEstateRepository repo)
        {
            repository = repo;
        }

        public ViewResult Index()
        {
            return View();
        }

        /// <summary>
        /// Представленипе списка объектов выбраного типа недвижимости
        /// </summary>
        /// <returns></returns>
        public ViewResult List(string typeRealState, string typeOperation, int page = 1)
        {
            ViewBag.Masseg = typeRealState ?? TypeOp;           
            TypeOp = typeRealState ?? TypeOp;

            RealEstateListViewModel model = new RealEstateListViewModel
            {

                RealEstates = repository.RealEstates
                .Where(b => typeOperation == null || b.TypeOfOperations == typeOperation )
                .Where(с => с.Type == TypeOp)
                .OrderBy(realEstate => realEstate.Id)
                .Skip((page - 1) * pageSize)
                .Take(pageSize),
                PagingInfo = new PagingInfo
                {
                    CurrentPage = page,
                    ItemsPerPage = pageSize,
                    TotalItems = typeOperation == null ?
                    repository.RealEstates.Where(re => re.Type == TypeOp).Count() :
                    repository.RealEstates.Where(re => re.TypeOfOperations == typeOperation && re.Type == TypeOp).Count()
                },
                CurrentTypeOfOperations = typeOperation
            };
            return View(model);
        }
        /// <summary>
        /// Представленипе списка объектов недвижимости
        /// </summary>
        /// <returns></returns>
        public ViewResult ListAll(string typeOperation, int page = 1)
        {
            TypeOp = null;

            RealEstateListViewModel model = new RealEstateListViewModel
            {

                RealEstates = repository.RealEstates
                .Where(b => typeOperation == null || b.TypeOfOperations == typeOperation)
                .OrderBy(realEstate => realEstate.Id)
                .Skip((page - 1) * pageSize)
                .Take(pageSize),
                PagingInfo = new PagingInfo
                {
                    CurrentPage = page,
                    ItemsPerPage = pageSize,
                    TotalItems = typeOperation == null ?
                    repository.RealEstates.Count() :
                    repository.RealEstates.Where(re => re.TypeOfOperations == typeOperation ).Count()
                },
                CurrentTypeOfOperations = typeOperation
            };
            return View(model);
        }


        /// <summary>
        /// Представленипе списка объектов выбраного типа недвижимости
        /// </summary>
        /// <returns></returns>
        public ViewResult ListAllFilter(decimal costBeginS, decimal costOfS, string citi, string category, string rayon, string typeOperation, int page = 1)
        {
            //decimal costBeginS = Convert.ToDecimal(costBegin);
            //decimal costOfS = Convert.ToDecimal(costOf);

            category = category ?? "";
            citi = citi ?? "";
            rayon = rayon ?? "";

            costBeginS = costBeginS == 0 ? 5 : costBeginS;
            costOfS = costOfS == 0 ? 100000000 : costOfS;
            

            if (TypeOp == null)
            {
                RealEstateListViewModel model = new RealEstateListViewModel
                {
                    RealEstates = repository.RealEstates
                    .Where(b => typeOperation == null || b.TypeOfOperations == typeOperation)
                    .Where(с => с.Category == category)
                    .Where(с => с.Citi == citi)
                    .Where(с => с.InhabitedLocalityAndDistrict == rayon)
                    .Where(с => с.Budget > costBeginS && с.Budget < costOfS)
                    .OrderBy(realEstate => realEstate.Id)
                    .Skip((page - 1) * pageSize)
                    .Take(pageSize),
                    PagingInfo = new PagingInfo
                    {
                        CurrentPage = page,
                        ItemsPerPage = pageSize,
                        TotalItems = typeOperation == null ?
                    repository.RealEstates.Where(re => re.Category == category&& re.Citi == citi && re.Citi == citi).Count() :
                    repository.RealEstates.Where(re => re.TypeOfOperations == typeOperation && re.Category == category&& re.Citi == citi).Count()
                    },
                    CurrentTypeOfOperations = typeOperation
                };
                return View(model);
            }
            else
            {
                RealEstateListViewModel model = new RealEstateListViewModel
                {
                    RealEstates = repository.RealEstates
                    .Where(b => typeOperation == null || b.TypeOfOperations == typeOperation)
                    .Where(с => с.Type == TypeOp)
                    .Where(с => с.Category == category)
                    .Where(с => с.Citi == citi)
                    .Where(с => с.InhabitedLocalityAndDistrict == rayon)
                    .Where(с => с.Budget > costBeginS && с.Budget < costOfS)
                    .OrderBy(realEstate => realEstate.Id)
                    .Skip((page - 1) * pageSize)
                    .Take(pageSize),
                    PagingInfo = new PagingInfo
                    {
                        CurrentPage = page,
                        ItemsPerPage = pageSize,
                        TotalItems = typeOperation == null ?
                    repository.RealEstates.Where(re => re.Type == TypeOp && re.Category == category && re.InhabitedLocalityAndDistrict == rayon).Count() :
                    repository.RealEstates.Where(re => re.TypeOfOperations == typeOperation && re.Type == TypeOp && re.Category == category && re.Citi == citi && re.InhabitedLocalityAndDistrict == rayon).Count()
                    },
                    CurrentTypeOfOperations = typeOperation
                };
                return View(model);
            }
        }





        /// <summary>
        /// Генерируем отображение страницы для объекта недвижимости 
        /// </summary>
        /// <param name="item_id">Индификационный номер недвижимости</param>
        /// <returns></returns>
        public ViewResult ObjectREPage(int item_id)
        {
            RealEstate realEstate = repository.FaindReal(item_id);

            return View(realEstate);
        }

        public ViewResult ONas()
        {
            return View();
        }

    }
}