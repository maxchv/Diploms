using Cub.Domian.Abstract;
using Cub.Domian.Entitis;
using System;
using System.Collections.Generic;
using System.Data;
using System.Data.Entity;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Cub.Domian.Concrete
{
    public class EFOrderRepository:IOrderRepository
    {       

        EFDbContext context = new EFDbContext();
        public IEnumerable<Order> Orders
        {
            get { return context.Orders; }
        }


        public void SaveOrder(Order order)
        {
            if (order.Id != 0)
            {
                //order.Date = DateTime.Now;
                //order.City = "Отсутствует";
                //order.Region = "Отсутствует";
                //order.Street = "Отсутствует"; 
                order.TypeOfLodging = "Отсутствует";
                //order.CostOf = 0;
                //order.CostBegin = 0;
                context.Entry(order).State = EntityState.Added;
            }
            else
            {
                order.Date = DateTime.Now;
                //order.RealEstateId = null;
                order.Region = "Отсутствует";
                order.Street = "Отсутствует";
                order.TypeOfLodging = "Отсутствует"; 
                context.Entry(order).State = EntityState.Added;
            }
            context.SaveChanges();
        }
    }
}
