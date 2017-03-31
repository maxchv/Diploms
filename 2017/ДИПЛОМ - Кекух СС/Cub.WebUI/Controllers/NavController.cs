using Cub.Domian.Abstract;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;

namespace Cub.WebUI.Controllers
{
    public class NavController : Controller
    {
        // GET: Nav
        private IRealEstateRepository repository;

        public NavController(IRealEstateRepository repo)
        {
            repository = repo;
        }

        public PartialViewResult Menu(string typeOperation = null)
        {
            ViewBag.SelectedTypeOperation = typeOperation;
            IEnumerable<string> typeOperations = repository.RealEstates
                .Select(re => re.TypeOfOperations)
                .Distinct()
                .OrderBy(x => x);
            return PartialView(typeOperations);
        }

        public PartialViewResult MenuAll(string typeOperation = null)
        {
            ViewBag.SelectedTypeOperation = typeOperation;
            IEnumerable<string> typeOperations = repository.RealEstates
                .Select(re => re.TypeOfOperations)
                .Distinct()
                .OrderBy(x => x);
            return PartialView(typeOperations);
        }
    }
}