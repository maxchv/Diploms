using Cub.Domian.Abstract;
using Cub.Domian.Entitis;
using System;
using System.Collections.Generic;
using System.Data.Entity;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Cub.Domian.Concrete
{
    public class EFOrderClientRepository: IOrderСlientRepository
    {
        EFDbContext context = new EFDbContext();
        public IEnumerable<OrderClient> OrderClients
        {
            get { return context.OrderClients; }
        }


        public void SaveOrder(OrderClient order)
        {
            order.Date = DateTime.Now;
            context.Entry(order).State = EntityState.Added;          
            context.SaveChanges();
        }
    }
}
