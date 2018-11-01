from nose.tools import *
from TryCatch import *

class testTryCatch:
  def testResult(self):
    try1 = TryCatch(0)
    res = try1.result(0)
    eq_(res,"ok")
