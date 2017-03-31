using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using Cub.Domian.Entitis;

namespace Cub.WebUI.Models
{
    public class RealEstateListViewModel
    {
        public IEnumerable<RealEstate> RealEstates { get; set; }
        public IEnumerable<Order> Orders { get; set; }
        public IEnumerable<OrderClient> OrderClients { get; set; }
        public PagingInfo PagingInfo { get; set; }        
        public string CurrentTypeOfOperations { get; set; }
        public string Type { get; set; }

        //------------------------------------------------

        public IQueryable<RealEstate> Temps { get; set; }
    }
}
