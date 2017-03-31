using Cub.Domian.Entitis;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Cub.Domian.Abstract
{
    public interface IOrderRepository
    {        
        IEnumerable<Order> Orders { get; }
        void SaveOrder(Order order);
    }
}
