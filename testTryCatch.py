from nose.tools import *
from TryCatch import *

class testTryCatch:
  def testResult(0):
    try1 = TryCatch(0)
    try2 = TryCatch(1)
    res = try.result(try2)
    eq_(res,"ok")
