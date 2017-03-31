using System;
using System.Collections.Generic;
using System.Data;
using System.Data.Entity;
using System.Linq;
using System.Net;
using System.Web;
using System.Web.Mvc;
using Cub.Domian.Concrete;
using Cub.Domian.Entitis;

namespace Cub.WebUI.Areas.Admin.Controllers
{
    [Authorize]
    public class OrdersController : Controller
    {
        private EFDbContext db = new EFDbContext();

        // GET: Admin/Orders
        public ActionResult Index()
        {
            var orders = db.Orders.Include(o => o.RealEstate);
            return View(orders.ToList());
        }

        // GET: Admin/Orders/Details/5
        public ActionResult Details(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            Order order = db.Orders.Find(id);
            if (order == null)
            {
                return HttpNotFound();
            }
            return View(order);
        }

        // GET: Admin/Orders/Create
        public ActionResult Create()
        {
            ViewBag.RealEstateId = new SelectList(db.RealEstates, "Id", "Type");
            return View();
        }

        // POST: Admin/Orders/Create
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for 
        // more details see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Create([Bind(Include = "Id,RealEstateId,Name,Date,City,Region,Street,TypeOfLodging,CostOf,CostBegin,AdditionalInfo,Phone,Email,Relevance,OurOfferToYou,ContactMeByPhone,ContactMeByEmail,Agreement")] Order order)
        {
            if (ModelState.IsValid)
            {
                db.Entry(order).State = System.Data.Entity.EntityState.Added;                
                db.SaveChanges();
                return RedirectToAction("Index");
            }

            ViewBag.RealEstateId = new SelectList(db.RealEstates, "Id", "Type", order.RealEstateId);
            return View(order);
        }

        // GET: Admin/Orders/Edit/5
        public ActionResult Edit(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            Order order = db.Orders.Find(id);
            if (order == null)
            {
                return HttpNotFound();
            }
            ViewBag.RealEstateId = new SelectList(db.RealEstates, "Id", "Type", order.RealEstateId);
            return View(order);
        }

        // POST: Admin/Orders/Edit/5
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for 
        // more details see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Edit([Bind(Include = "Id,RealEstateId,Name,Date,City,Region,Street,TypeOfLodging,CostOf,CostBegin,AdditionalInfo,Phone,Email,Relevance,OurOfferToYou,ContactMeByPhone,ContactMeByEmail,Agreement")] Order order)
        {
            if (ModelState.IsValid)
            {
                db.Entry(order).State = System.Data.Entity.EntityState.Modified;
                db.SaveChanges();
                return RedirectToAction("Index");
            }
            ViewBag.RealEstateId = new SelectList(db.RealEstates, "Id", "Type", order.RealEstateId);
            return View(order);
        }

        // GET: Admin/Orders/Delete/5
        public ActionResult Delete(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            Order order = db.Orders.Find(id);
            if (order == null)
            {
                return HttpNotFound();
            }
            return View(order);
        }

        // POST: Admin/Orders/Delete/5
        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        public ActionResult DeleteConfirmed(int id)
        {
            Order order = db.Orders.Find(id);
            db.Orders.Remove(order);
            db.SaveChanges();
            return RedirectToAction("Index");
        }

        protected override void Dispose(bool disposing)
        {
            if (disposing)
            {
                db.Dispose();
            }
            base.Dispose(disposing);
        }
    }
}
