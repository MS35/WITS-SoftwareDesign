from nose.tools import *
from TryCatch import *

class testTryCatch:
  def testResult(self):
    try1 = TryCatch()
    res = try1.result()
    eq_(res,"ok")
