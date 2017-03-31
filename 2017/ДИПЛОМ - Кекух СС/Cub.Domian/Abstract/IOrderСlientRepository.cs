using Cub.Domian.Entitis;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Cub.Domian.Abstract
{
    public interface IOrderСlientRepository
    {
        IEnumerable<OrderClient> OrderClients { get; }
        void SaveOrder(OrderClient orderClient);
    }
}
